<?php

class Solution
{
    /**
     * 循环 O(logN) O(1)
     * @param Integer $n
     * @return Integer
     */
    function reverseBits($n)
    {
        $ans = 0; $count = 31;
        while($n > 0) {
            $ans += (($n & 1) << $count);
            $count--;
            $n = ($n >> 1);
        }
        return $ans;
    }

    /**
     * 分治 O(1) O(1)
     * @param Integer $n
     * @return Integer
     */
    function reverseBits2($n)
    {
        $n = (($n & 0x0000FFFF) << 16) | (($n & 0xFFFF0000) >> 16);
        $n = (($n & 0x00FF00FF) <<  8) | (($n & 0xFF00FF00) >>  8);
        $n = (($n & 0x0F0F0F0F) <<  4) | (($n & 0xF0F0F0F0) >>  4);
        $n = (($n & 0x33333333) <<  2) | (($n & 0xCCCCCCCC) >>  2);
        $n = (($n & 0x55555555) <<  1) | (($n & 0xAAAAAAAA) >>  1);
        return $n;
    }
}

$n = 0b1010;
$ret = (new Solution())->reverseBits($n);
print_r(decbin($ret));
