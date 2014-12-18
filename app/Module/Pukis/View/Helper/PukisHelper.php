<?php 

/**
 * This class only used for pukis layout cosmetics
 * @author ”Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>”
 *
 */
class PukisHelper extends AppHelper {
	
	/**
	 * Get title 
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		$output = "";
		$output.= '<ol class="breadcrumb">';
		$output.= '<li>PUKIS</li>';
		$output.= '<li>' . $this->params['plugin'] . '</li>';
		$output.= '<li>' . $this->params['controller'] . '</li>';
		$output.= '<li class="active">'  . str_replace('admin_', '', $this->params['action']) .  '</li>';
		$output.= '</ol>';
		
		return $output;
	}
	
	
}

?>