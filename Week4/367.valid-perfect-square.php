<?php

class Solution
{

    /**
     * 一、牛顿迭代 O(LogN) O(1)
     * @param Integer $num
     * @return Boolean
     */
    function isPerfectSquare($num)
    {
        if ($num < 2) return true;
        $x = ($num >> 1);
        while ($x ** 2 > $num) {
            //print_r('x0:' . $x . PHP_EOL);
            $x = (($x + ($num / $x)) >> 1);
            //print_r('x1:' . $x . PHP_EOL);
        }
        return $x ** 2 == $num;
    }

    /**
     * 二、二分查找 O(LogN) O(1)
     * @param Integer $num
     * @return Boolean
     */
    function isPerfectSquare2($num)
    {
        if ($num < 2) return true;
        $l = 2;
        $r = ($num >> 1);
        while ($l <= $r) {
            $mid = $l + (($r - $l) >> 1);
            if ($mid ** 2 == $num) return true;
            if ($mid ** 2 > $num) {
                $r = $mid - 1;
            } else {
                $l = $mid + 1;
            }
        }
        return false;
    }

}

$num = 14;
$s = new Solution();
$ret = $s->isPerfectSquare2($num);
var_dump($ret);