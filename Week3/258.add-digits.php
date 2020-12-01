<?php

class Solution
{

    /**
     * O(1) O(1)
     *
     * @param Integer $num
     * @return Integer
     */
    function addDigits($num)
    {
        return ($num - 1) % 9 + 1;
    }
}

$num = 123;
$s = new Solution();
$ret = $s->addDigits($num);
print_r($ret);