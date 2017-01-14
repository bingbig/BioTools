<?php

require '../vendor/autoload.php';

use BioTools\Tree\TreeJson;
use BioTools\Tree\TreeFileFormat;


$test = new TreeJson('A',1);

$test->B(2)->C(3)->D(4);
$test->E(3);
var_dump(TreeFileFormat::JsonToNewick(json_encode($test)));
var_dump(json_encode($test));
$test = new TreeJson('A');
$test->B()->C()->D();
$test->E();
var_dump(json_encode($test));