<?php 

App::uses('Component', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

/**
 * AclPermissionsComponent
 *
 * @category Component
 * @package  Module.Users.Controller
 * @version  1.0
 * @author Luis Fred G S <luis.fred.gs@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class AclPermissionsComponent extends Component
{
	/**
	 * Controller methods by delegation
	 * @var string
	 * @access public
	 **/
	protected $_controller = null;

	/**
	 * startup - Fired after the controller's beforeFilter method.
	 * @return void
	 * @access public
	 **/
	public function startup( Controller $controller )
	{
		$this->_controller = $controller;
	}

	/**
	 * initialize - Fired before the controller's beforeFilter method.
	 * @return void
	 * @access public
	 **/
	public function initialize( Controller $controller )
	{
		$this->_controller = $controller;
	}

	/**
	 * filter - access control for all sections on application
	 * @return void
	 * @access public
	 **/
	public function filter()
	{			
		$this->_controller->Auth->authenticate = array(
		 	AuthComponent::ALL => array(
		 		'userModel' => 'Admin.User',
		 		'fields' => array(
		 			'username' => 'username',
		 			'password' => 'password',
		 		),
		 		'scope' => array(
		 			'User.status' => 1,
		 		),
		 	),
		 	'Form',
		 );
		 
		 $actionPath = 'controllers';
		 $this->_controller->Auth->authorize = array(
		 	AuthComponent::ALL => array(
		 		'actionPath' => $actionPath,
		 		'userModel' => 'Admin.User',		 		
		 		),
		 	'Actions',
		 );
		
		 $this->_controller->Auth->loginAction = array(
		     'plugin' => 'admin',
		     'controller' => 'users',
		     'action' => 'login',
		     'admin' => true
		 );
		
		 $this->_controller->Auth->logoutRedirect = array(
		     'plugin' => 'admin',
		     'controller' => 'users',
		     'action' => 'login',
		 );
		
		 $this->_controller->Auth->loginRedirect = array(
		     'plugin' => 'admin',
		     'controller' => 'dashboard',
		     'action' => 'index',
		 );

		 $this->_controller->Auth->unauthorizedRedirect = array(
		 	'plugin' => 'admin',
		 	'controller' => 'users',
		 	'action' => 'login',
		 	);

		 $this->_controller->Auth->flash['element'] = 'flash_warning';
		 $this->_controller->Auth->authError = __d('admin', 'You have no authority to access this router.');
		if ( $this->_controller->Auth->user() && $this->_controller->Auth->user('role_id') == 1 )
		{						
		    $this->_controller->Auth->allow();		    
		}else{
		    if ( $this->_controller->Auth->user() )
		    {
		        $roleId = $this->_controller->Auth->user('role_id');
		    }else{	
		    	$id = ClassRegistry::init('Admin.Role')->field('id', array('alias' => 'public'));
		    	ClassRegistry::init('Admin.Role')->id = $id;
		    	$roleId =  ClassRegistry::init('Admin.Role')->exists() ? $id : 3;
		    }
			
		    $aro = $this->_controller->Acl->Aro->find('first', array(
		        'conditions' => array(
		            'Aro.model' => 'Role',
		            'Aro.foreign_key' => $roleId
		        )
		    ));	
		    $aroId = $aro['Aro']['id'];
		    $thisControllerNode = $this->_controller->Acl->Aco->node('controllers/' . $this->_controller->name);		    
		    if ( $thisControllerNode )
		    {
		        $thisControllerActions = $this->_controller->Acl->Aco->find('list', array(
		         'conditions' => array(
		             'Aco.parent_id' => $thisControllerNode['0']['Aco']['id']
		          ),
		         'fields' => array(
		          'Aco.id',
		          'Aco.alias'
		         ),
		         'recursive' => '-1'
		        ));
		        $thisControllerActionsIds = array_keys($thisControllerActions);
		        
		        $allowedActions = $this->_controller->Acl->Aco->Permission->find('list', array(
		         'conditions' => array(
		             'Permission.aro_id' => $aroId,
		             'Permission.aco_id' => $thisControllerActionsIds,
		             'Permission._create' => 1,
		             'Permission._read' => 1,
		             'Permission._update' => 1,
		             'Permission._delete' => 1,
		         ),
		          'fields' => array(
		              'id',
		              'aco_id'
		          ),
		          'recursive' => '-1'
		        ));  
		        $allowedActionsIds = array_values($allowedActions);                       
		    }
	        $allow = array();
	        if ( isset($allowedActionsIds) && is_array($allowedActionsIds) && count($allowedActionsIds) )
	        {
	            foreach($allowedActionsIds as $i => $aId)
	            {
	                $allow[] = $thisControllerActions[$aId];
	            }                   
	        }
	        $this->_controller->Auth->allowedActions = $allow;  
		}  
		       
	}
}

 ?>