<?php

class Solution
{

    /**
     * 一、牛顿迭代法 O(LogX) O(1) 此方法是二次收敛的，相较于二分查找更快。
     * 2XiX = Xi^2 + C => Xi+1 = 0.5 * (Xi + C / Xi)
     * @param Integer $x
     * @return Integer
     */
    function mySqrt($x)
    {
        if ($x == 0) return 0;
        $x0 = $c = $x;
        while (true) {
            $xi = 0.5 * ($x0 + $c / $x0);
            if (abs($xi - $x0) < 1e-5) { //php科学计数法
                break;
            }
            $x0 = $xi;
        }
        return (int)$x0;
    }

    /**
     * 二、二分查找 O(LogX) O(1)
     * @param Integer $x
     * @return Integer
     */
    function mySqrt2($x)
    {
        $l = 0; $r = $x; $ans = -1;
        while($l <= $r) {
            $mid = $l + (($r - $l) >> 1);
            if($mid ** 2 <= $x) {
                $ans = $mid;
                $l = $mid + 1;
            }else{
                $r = $mid - 1;
            }
        }
        return $ans;
    }
}

/**
 * 输入: 8
 * 输出: 2
 * 说明: 8 的平方根是 2.82842...,
 * 由于返回类型是整数，小数部分将被舍去。
 */

$x = 8;
$s = new Solution();
$ret = $s->mySqrt2($x);
print_r($ret);