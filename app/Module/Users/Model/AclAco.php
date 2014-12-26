<?php

/**
 * AclAco
 *
 * @category Model
 * @package  Module.User.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('UsersAppModel', 'Users.Model');

class AclAco extends UsersAppModel {

	/**
	 * name
	 *
	 * @var string
	 */
	public $name = 'AclAco';

	/**
	 * useTable
	 *
	 * @var string
	 */
	public $useTable = 'acos';

	/**
	 * actsAs - Acl Behavior
	 *
	 * @var array
	 */
	public $actsAs = array('Tree', 'Containable');

	/**
	 * Recursive find for parent aco id
	 * 
	 * @param integer $acoParentId
	 * @return array
	 * @access public
	 */
	public function findParentId($acoParentId)
	{	
		$acoId = array();
		
		$parent = $this->find('first', array(
			'conditions' => array('AclAco.id' => $acoParentId)));
		if (!empty($parent)) {
			if (!empty($parent['AclAco']['parent_id'])) {
				$parentId = $this->findParentId($parent['AclAco']['parent_id']);
				$acoId = Hash::merge($acoId, $parentId);
			}
			
			$acoId[] = $parent['AclAco']['id'];
		}
		
		return $acoId;
	}
	
	/**
	 * Recursive find for child aco id
	 * 
	 * @param integer $acoId
	 * @return array
	 * @access public
	 */
	public function findChildId($acoId)
	{
		$acoId = array();
		
		$childs = $this->find('all', array(
			'conditions' => array('AclAco.parent_id' => $acoId)));
		if (!empty($childs)) {
			foreach ($childs as $child) {
				$childId = $this->findChildId($child['AclAco']['id']);
				if (!empty($childId)) {
					$acoId = Hash::merge($acoId, $childId); 
				}
				
				$acoId[] = $child['AclAco']['id'];
			}
		}
		
		return $acoId;
	}
	
}
