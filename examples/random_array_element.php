<?php

include getcwd() . '../vendor/autoload.php';

$array = array(
    'element1',
    'element2'
);

$arrayManipulator = new Moriony\Trivial\Manipulator\ArrayManipulator;
$result = $arrayManipulator->randomElement($array);

print_r($result);

