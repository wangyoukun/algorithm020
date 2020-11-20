<?php

class Solution
{

    /**
     * 一、递归快速幂 O(logN) O(logN)
     * @param Float $x
     * @param Integer $n
     * @return Float
     */
    function myPow1($x, $n)
    {
//        if ($n < 0) {
//            return 1 / $this->dg($x, -$n);
//        } else {
//            return $this->dg($x, $n);
//        }
        if ($n < 0) {
            $x = 1 / $x;
            $n = -n;
        }
        return $this->dg($x, $n);
    }

    function dg($x, $n)
    {
        if ($n == 0) return 1;
        $half = $this->dg($x, $n / 2);
        if ($n % 2 == 0) {
            return $half * $half;
        } else {
            return $half * $half * $x;
        }
    }

    /**
     * 二、迭代快速幂 O(logN) O(1)
     * @param Float $x
     * @param Integer $n
     * @return Float
     */
    function myPow($x, $n)
    {
//        if ($n < 0) {
//            return 1 / $this->dd($x, -$n);
//        } else {
//            return $this->dd($x, $n);
//        }
        if ($n < 0) {
            $x = 1 / $x;
            $n = -$n;
        }
        return $this->dd($x, $n);
    }

    function dd($x,$n) {
        if ($n == 0) return 1;
        $ret = 1;
        while ($n) {
            if (($n & 1)) $ret *= $x;
            $x *= $x;
            $n >>= 1;
        }
        return $ret;
    }
}

$x = 2;
$n = -2;
$s = new Solution();
$ret = $s->myPow($x, $n);
print_r($ret);