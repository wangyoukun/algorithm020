<?php

class Solution
{

    /**
     * 双指针模拟竖式加法 O(Max($str1,$str2)) => O(n) O(1)
     * @param String $num1
     * @param String $num2
     * @return String
     */
    function addStrings($num1, $num2)
    {
        $p1 = strlen($num1) - 1;
        $p2 = strlen($num2) - 1;
        $carry = 0;
        $ret = '';
        while ($p1 > -1 || $p2 > -1 || $carry != 0) {
            $x = $p1 > -1 ? $num1[$p1] : 0;
            $y = $p2 > -1 ? $num2[$p2] : 0;
            $sum = $x + $y + $carry;
            $ret .= $sum % 10;
            $carry = floor($sum / 10);
            $p1--;
            $p2--;
        }
        return strrev($ret);
    }
}

$a = '56789';
$b = '1234';
$s = new Solution();
$ret = $s->addStrings($a, $b);
print_r($ret);
