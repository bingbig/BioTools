<?php
require '../vendor/autoload.php';

use BioTools\Tree\TreeFileFormat;

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


$newick1 = TreeFileFormat::ArrayToNewick($tree_array);
$newick2 = TreeFileFormat::JsonToNewick($tree_json);

echo $newick1 == $tree_newick ? 'Success' : 'Failed';
echo "\n";
echo $newick2 == $tree_newick ? 'Success' : 'Failed';
echo "\n";
