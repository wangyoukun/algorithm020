<?php
/**
 * @param Integer[] $nums
 * @param Integer $target
 * @return Integer[]
 */
function twoSum($nums, $target) {
    $hash = [];
    for($i = 0; $i < count($nums);$i++) {
        if(array_key_exists($target - $nums[$i],$hash)){
            return [$hash[$target - $nums[$i]],$i];
        }
        $hash[$nums[$i]] = $i;
    }
    return [];
}

