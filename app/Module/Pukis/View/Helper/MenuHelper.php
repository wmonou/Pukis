<?php 

/**
 * 
 * @author ”Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>”
 *
 */

/**
 * Usage of Menu Helper
 * You have array set on your controller for your menu
 * $menu = array(
 * 		['pukis'] => array (
 *           ['title'] => Pukis Repository
 *           ['url'] => #
 *           ['icon'] => fa fa-github
 *           ['children'] => array (
 *           	['fork'] => array (
 *              	['title'] => Fork
 *                  ['url'] => #
 *                  ['icon'] => fa fa-code-fork
 *              )
 *          	['star'] => array (
 *              	[title] => Star
 *                  [url] => #
 *              )
 *              ['download'] => array (
 *              	['title'] => Star
 *                  ['url'] => #
 *                  ['icon'] => fa fa-cloud-download
 *                  ['children'] => array (
 *                  ...
 *                  )
 *              )
 *           )
 *       ) ...
 * You want to generate the menu
 * echo $this->Menu->createMenu($menu);
 */
class MenuHelper extends AppHelper
{
	/**
	 * Helper used in this helper
	 * @var array
	 */
    public $helpers = array('Html');
	
	/**
	 * 
	 * @param array $menus
	 */
	public function createMenu($menus) 
	{
		$output = '<nav class="sidebar-nav">';
		$output.= $this->_createItem($menus, true);
		$output.= '</nav>';
		
		return $output;
	}
	
	/**
	 * 
	 * @param unknown $items
	 * @param unknown $options
	 */
	private function _createItem($items, $active = false)
	{
		$output = "";
		
		if (array($items)) {
			$output.= '<ul id="menu">';
			
			foreach ($items as $itemKey => $itemValue) {
				$class = ($active)? 'class="active"' : '';
				$output.= '<li ' . $class . '>';
				$active = false;
				
				$output.= $this->_createLink($itemKey, $itemValue);
				if(isset($itemValue['children']) && !empty($itemValue['children'])){
					$output.= '<ul>';
					$output.= $this->_createItem($itemValue['children']);
					$output.= '</ul>';
				}
				
				$output.= '<li>';
			}
			
			$output.= '</ul>';
		}
		
		return $output;
	}
	
	
	/**
	 * 
	 * @param unknown $menu
	 * @param unknown $options
	 * @return unknown
	 */
	private function _createLink($link, $options = array())
	{
		if (!empty($options)) {
			$icon = $this->Html->tag(
					'span',
					'&nbsp;',
					array('class' => 'sidebar-nav-item-icon '. $options['icon'] .' hidden-xs'));
			$item = $this->Html->tag(
					'span',
					!($options['title'])? $link : $options['title'],
					array('class' => 'sidebar-nav-item'));
			$arrow = $this->Html->tag(
					'span', 
					'&nbsp;', 
					array('class' => 'sidebar-nav-item-icon fa arrow hidden-xs'));
			$output = $this->Html->link(
					(!empty($options['children']))? $icon . $item . $arrow : $icon . $item, 
					!($options['url'])? '#' : $options['url'],
					array(
						'class' => ($options['url'] != '#')? 'sidebar-nav-item-a' : 'sidebar-nav-item-i', 
						'escape' => false));
		} else {
			$output = $this->Html->link($link, '#');
		}
		
		return $output;
	}
	
}
