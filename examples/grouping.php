<?php

include '../vendor/autoload.php';

$array = array(
    array(
        "result" => "success",
        "user" => "Duffy",
        "message" => "11111111111oneoneoneone!!!"
    ),
    array(
        "result" => "error",
        "user" => "Porky",
        "message" => "22222222222twotwotwotwo!!!"
    ),
);

$arrayManipulator = new Moriony\Trivial\Manipulator\Arrays;

$result = $arrayManipulator->group($array, array(
    function ($item) {
        return $item['user'];
    },
    function ($item) {
        return $item['result'];
    }
));

print_r($result);

