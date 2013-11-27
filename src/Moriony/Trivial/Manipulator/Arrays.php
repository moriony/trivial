<?php

namespace Moriony\Trivial\Manipulator;

use Closure;

class Arrays
{
    /**
     * Group values from array according to the results of a closure
     *
     * @param array $array
     * @param Closure|Closure[] $groupers
     * @return array
     */
    public function group(array $array, $groupers)
    {
        if (!is_array($groupers)) {
            $groupers = array($groupers);
        }

        $grouper = array_shift($groupers);

        $result = array();
        foreach ($array as $key => $value) {
            $key = call_user_func($grouper, $value, $key);
            $result[$key][] = $value;
        }

        if (!empty($groupers)) {
            foreach ($result as & $item) {
                $item = $this->group($item, $groupers);
            }
        }
        return $result;
    }
}