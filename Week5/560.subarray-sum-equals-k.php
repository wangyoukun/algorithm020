<?php

class Solution
{

    /**
     * 一 枚举 O(n^2) O(1)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function subarraySum($nums, $k)
    {
        $count = 0;
        for ($i = 0; $i < count($nums); $i++) {
            $sum = 0;
            for ($j = $i; $j >= 0; $j--) {
                $sum += $nums[$j];
                if ($sum == $k) {
                    $count++;
                }
            }
        }
        return $count;
    }

    /**
     * 一 前缀和 + 哈希 O(n) O(n)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function subarraySum2($nums, $k)
    {
        $count = 0;
        $hash = [];
        $sum = 0;
        for ($i = 0; $i < count($nums); $i++) {
            $sum += $nums[$i];
            if ($sum == $k) {
                $count++;
            }
            if (isset($hash[$sum - $k])) $count += $hash[$sum - $k];
            if (!isset($hash[$sum])) {
                $hash[$sum] = 1;
            } else {
                $hash[$sum]++;
            }
        }
        return $count;
    }
}

/**
 * 输入:nums = [1,1,1], k = 2
 * 输出: 2 , [1,1] 与 [1,1] 为两种不同的情况。
 * 输入: nums = [0,0,0,0,0,0,0,0,0,0] , k = 0
 * 输出: 55
 */

$nums = [1, 1, 1];
$k = 2;
$nums = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
$k = 0;
$s = new Solution();
$ret = $s->subarraySum2($nums, $k);
print_r($ret);
