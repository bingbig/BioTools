<?php

namespace BioTools\Tree;

/**
 * Generate a JSON object
 * 
 * return 
 */
class TreeJson
{
	/**
	 * The name of the clade
	 */
	public $name;


	/**
	 * construct
	 */
	public function __construct($name,$len=null) {
		$this->name = $name;
		if($len) $this->setBranchLength($len);
		return $this;
	}

	/**
	 * Set the branch
	 */
	public function setBranchLength($len=null)
	{
		if($len) $this->branch_length = $len;
	}

	/**
	 * add a child
	 */
	public function addChild($name,$len=null) {
		$this->children[] = new TreeJson($name,$len);
	}

	/**
	 * Get the child. 
	 * 
	 * @return TreeJson Object
	 */
	public function __call($name,$len=null) {
		$child = $this->getChildByName($this,$name);
		if(!$child) {
			// can not find the child, build one
			isset($len[0]) ? $this->addChild($name,$len[0]) : $this->addChild($name);
			return $this->getChildByName($this,$name);
		}
		else {
			// find the one, update branch_length maybe
			isset($len[0]) ? $child->setBranchLength($len[0]) : '';
			return $child;
		}
	}

	/**
	 * get child by name
	 * 
	 * @return mixed
	 */

	public function getChildByName ($obj,$name) {
		// Can find the child, return object
		if(isset($obj->children)){
			foreach ($obj->children as $child) {
				if($child->name == $name) {
					return $child;
				}
			}
		}
		// Can not, return null
		return null;
	}
}

