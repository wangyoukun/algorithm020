<?php

class Solution
{

    /**
     * 数组 O(n) O(1)
     * @param Integer[] $digits
     * @return Integer[]
     */
    function plusOne($digits)
    {
        $count = count($digits);
        for ($i = $count - 1; $i >= 0; $i--) {
            if($digits[$i] < 9) {
                $digits[$i]++;
                return $digits;
            }
            $digits[$i] = 0;
        }
        array_unshift($digits, 1);
        return $digits;
    }
}

$in = [0,0];
$in = [9];
$in = [1, 9, 9, 9];
$s = new Solution();
$ret = $s->plusOne($in);
print_r($ret);


