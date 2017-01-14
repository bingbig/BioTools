<?php
namespace BioTools\Tree;

/**
 * 
 ****** Here Is the Demon of data structure
 ### 'name' is necessary but branch_length is optional
 $tree_json = '{
		"name" : "F",
		"children": [
			{"name": "A", "branch_length": 0.1},
			{"name": "B", "branch_length": 0.2},
			{"name": "E","branch_length": 0.5,
				"children": [
					{"name": "C", "branch_length": 0.3},
					{"name": "D", "branch_length": 0.4}
				]
			}
		]
	}';
$tree_newick = '(A:0.1,B:0.2,(C:0.3,D:0.4)E:0.5)F;';
$tree_array = [
	'name'		=>	'F',
	'children'	=>	[
		['name'	=>	'A', 'branch_length'	=>	0.1],
		['name'	=>	'B', 'branch_length'	=>	0.2],
		[
			'name'	=>	'E', 
			'branch_length'	=>	0.5,
			'children'	=>	[
				['name'	=>	'C', 'branch_length'	=>	0.3],
				['name'	=>	'D', 'branch_length'	=>	0.4]
			]
		]
	]
];
 */
class TreeFileFormat
{
	/**
	 * Turn array to newick format string
	 *
	 * @param array $tree
	 * @return string
	 */
	static public function ArrayToNewick ($tree)
	{
		return self::JsonToNewick(json_encode($tree));
	}

	/**
	 * Turn Json to newick format string
	 *
	 * @param string $tree
	 * @return string
	 */

	static public function JsonToNewick ($tree)
	{
		return self::parseJsonObj(json_decode($tree)) . ';';
	}

	/**
	 * parse the json object and return newick
	 * 
	 * @param object $obj
	 * @return string $newick
	 */
	static private function parseJsonObj($obj){
		$newick = array_key_exists('name',$obj) ? $obj->name : '';
		$newick .= array_key_exists('branch_length',$obj) ? ':'.$obj->branch_length : '';

		if(array_key_exists('children',$obj)){
			$children = $obj->children;
			// var_dump($children);
			$info = [];
			foreach ($children as $child) {
				$info[] = self::parseJsonObj($child);
			}
			$info = implode(',',$info);
			$newick = '(' . $info . ')' .$newick;
		}
		return $newick;
	}
}