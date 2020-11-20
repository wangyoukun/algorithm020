<?php

class Solution
{

    /**
     * 双指针 倒序 O(m+n) O(1)
     * @param Integer[] $nums1
     * @param Integer $m
     * @param Integer[] $nums2
     * @param Integer $n
     * @return NULL
     */
    function merge(&$nums1, $m, $nums2, $n)
    {
        $p1 = $m - 1;
        $p2 = $n - 1;
        $p0 = $m + $n - 1;
        while ($p1 >= 0 && $p2 >= 0) {
            $nums1[$p0--] = $nums1[$p1] > $nums2[$p2] ? $nums1[$p1--] : $nums2[$p2--];
        }

        while ($p2 >= 0) {
            $nums1[$p0--] = $nums2[$p2--];
        }

    }
}

$in1 = [1, 2, 3, 0, 0, 0];
$in2 = [2, 5, 6];
$m = 3;
$n = 3;

$in1 = [0];
$in2 = [1];
$m = 0;
$n = 1;

$in1 = [-1, 0, 0, 3, 3, 3, 0, 0, 0];
$in2 = [1, 2, 2];
$m = 6;
$n = 3;


$s = new Solution();
$out = $s->merge($in1, $m, $in2, $n);
print_r($in1);
