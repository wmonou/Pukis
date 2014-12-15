<?php


class DataTablesComponent extends Component{
    
	/**
	 * DataTable Security
	 * 
	 * @var integer $_draw
	 * @access protected
	 */
	protected $_draw;
	
	/**
	 * 
	 * @var array $_model
	 * @access protected
	 */
    protected $_model;
    
    /**
     *
     * @var array $_recursive
     * @access protected
     */
    protected $_recursive = -1;
    
    /**
     * 
     * @var string $_controller
     * @access private
     */
    protected $_controller;
    
    /**
     * @var array $_conditions
     * @access protected
     */
    protected $_conditions = array();
    
    /**
     * Fields used for query
     *
     * @var array $_fields;
     * @access protected
     */
    protected $_fields = array();
    
    /**
     * Fields used for dataTable
     * 
     * @var array $_tableFields;
     * @access protected
     */
    protected $_datatableFields = array();
    
    
    /**
     * Fields used for linkable
     *
     * @var array $_linkableFields;
     * @access protected
     */
    protected $_linkableFields = array();
        
    /**
     *
     * @var array $order;
     * @access protected
     */
    protected $_order = array();
    
    /**
     *
     * @var integer $limit;
     * @access protected
     */
    protected $_limit;
    
    /**
     *
     * @var integer $ofset;
     * @access protected
     */
    protected $_ofset;
    
    /**
     * Constructor class
     */
    public function __construct(){
        
    }
    
    /**
     * (non-PHPdoc)
     * @see Component::initialize()
     */
    public function initialize(Controller $controller){
        $this->controller = $controller;
        $modelName = $this->controller->modelClass;
        $this->_model = $this->controller->{$modelName};
    }
    
    /**
     * Manualy set model used by components
     * 
     * @param string $modelName
     * @access public
     */
    public function setModel($modelName){
    	$this->_model = $this->controller->{$modelName};
    	return $this->_model;
    }
    
    /**
     * Manualy set conditions used by components
     *
     * @param array $conditions
     * @access public
     */
    public function setConditions($conditions){
    	$this->_conditions = $conditions;
    	return $this->_model;
    }
    
    /**
     * Manualy set model used by components
     *
     * @param string $modelName
     * @access public
     */
    public function setField($fieldlName){
    	$this->field = $fieldName;
    }
    
    /**
     * Get response from retreived data
     * 
     * @access public
     */
    public function getResponse(){
    	// count total
    	$count = $this->_model->find('count', array('conditions' => $this->_conditions));
    	
    	// retreive data
    	$this->_model->recursive = $this->_recursive;
    	$data = $this->_model->find('all', $this->_prepareDataTableQuery($this->controller->request->data));
    	return $this->_prepareDataTableResponse($count, $data); 
    }
    
    /**
     * Prepare data to be retreived
     *
     * @param request query $data
     * @return multitype:NULL string
     * @access public
     */
    protected function _prepareDataTableQuery($data){
    	$this->draw = $this->_setDataTableDraw($data);
    	return array(
    		'conditions' => $this->_conditions,
    		'fields' => $this->_setDataTableFields($data),
    		'order' => $this->_setDataTableOrderBy($data),
    		'limit' => $this->_setDataTableLimit($data),
    		'offset' => $this->_setDataTableOffset($data)
    	);
    }
    
    /**
     * Prepare data to send as response
     *
     * @param integer $count
     * @param array $data
     */
    protected function _prepareDataTableResponse($count, $responseData){
    	$responseJSON = array(
    		'draw' => intval($this->_draw),
    		'recordsTotal' => intval($count),
    		'recordsFiltered' => intval($this->_limit),
    		'data' => array()
    	);
    	
    	// return data
    	if(!$responseData){
    		return $responseJSON;
    	}
    	else {
    		$model = get_class($this->_model);
    		    		 
    		foreach ($responseData as $responseKey => $response){
    			// @todo handle recursive
    			foreach ($this->_datatableFields as $datatableFieldKey => $datatableField) {
    				if (isset($response[$model][$datatableField]) && isset($this->_linkableFields[$datatableField]['target'])) {
    					if(!is_array($this->_linkableFields[$datatableField]['target'])){
    						$responseJSON['data'][$responseKey][$datatableField] = 
    							$this->_generateHyperlink(
    									$response[$model][$datatableField],
    									$this->_linkableFields[$datatableField]['target'],
    									$this->_linkableFields[$datatableField]['htmlClass']);
   						
    					} 
    					else {
    						$responseJSON['data'][$responseKey][$datatableField] = "";
    						foreach ($this->_linkableFields[$datatableField]['target'] as $targetKey => $target) {
    							$responseJSON['data'][$responseKey][$datatableField] .= " " .
	    							$this->_generateHyperlink(
	    									$targetKey,
	    									$target,
	    									$this->_linkableFields[$datatableField]['htmlClass'][$targetKey]);
	    							
    						}
    					}
    				} else if (isset($response[$model][$datatableField])) {
    					$responseJSON['data'][$responseKey][$datatableField] = $response[$model][$datatableField];
    				} else {
    					$responseJSON['data'][$responseKey][$datatableField] = "";
    				}
    			}
    		}
    		
    		return $responseJSON;
    	}
    }
    
    /**
     * Set cake style fields from data table
     *
     * @access private
     */
    protected function _setDataTableFields($data){
		// field for data table 
    	if(empty($this->_datatableFields) && !empty($data['columns'])){
    		foreach ($data['columns'] as $column){
    			$this->_datatableFields[] = $column['data'];
    		}
    	}
    	
    	// field for actions
    	if(empty($this->_linkableFields) && !empty($data['actions'])){
    		foreach ($data['actions'] as $action){
    			// url target
    			if(isset($action['target']))
    				$this->_linkableFields[$action['data']]['target'] = $action['target'];
    			else
    				$this->_linkableFields[$action['data']]['target'] = "#";
    			// htmlClass
    			if(isset($action['htmlClass']))
    				$this->_linkableFields[$action['data']]['htmlClass'] = $action['htmlClass'];
    			else
    				$this->_linkableFields[$action['data']]['htmlClass'] = "";
    		}
    	}
    	
    	// field for query
    	if(empty($this->_fields) && !empty($this->_datatableFields)){
    		foreach ($this->_datatableFields as $field){
    			if($this->_model->hasField($field))    				
    				$this->_fields[] = $field;
    		}
    	}
    	
    	if(!array_search('a', $this->_fields))
    		return array_merge(array('id'), $this->_fields);
    	
    	return $this->_fields;
    }
    
	/**
	 * cake style order from data table
	 * 
	 * @param void
	 * @return string
	 */ 
    protected function _setDataTableOrderBy($data){
        if(empty($this->_order) && !empty($data['order'])){
        	foreach ($data['order'] as $order){
        		if($order['column'] !== false){
        			$this->_order[] = $this->_datatableFields[$order['column']] . ' ' . $order['dir'];  
        		}
        	}
        }
        
        return $this->_order;
    }
    
    /**
     * cake style limit from data table
     * 
     * @access private
     */
    protected function _setDataTableLimit($data){
    	if(empty($this->_limit) && !empty($data['length'])){
    		$this->_limit = $data['length'];
    	}
    	
    	return $this->_limit;
    }
    
    /**
     * cake style offset from data table
     * 
     * @access private
     */
    protected function _setDataTableOffset($data){
    	if(empty($this->_ofset) && !empty($data['start'])){
    		$this->_ofset = $data['start'];
    	}
    	
    	return $this->_ofset;
    }
    
    protected function _setDataTableDraw($data){
    	$this->_draw = $data['draw'];
    	
    	return $this->_draw;
    }
    
    protected function _generateHyperlink($name, $url = null, $htmlClass = null){
    	 $href = ($url)? "href='$url'" : "href='#'";
    	 $htmlClass = ($htmlClass)? "<i class='$htmlClass'></i> " : " ";
    	 return "<a $href>$htmlClass $name</a>";
    }
}