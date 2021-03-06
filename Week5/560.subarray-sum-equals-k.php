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

    /**
     * 一 前缀和 + 哈希 O(n) O(n)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function subarraySum3($nums, $k)
    {
        $count = 0;
        $hash = [0 => 1];
        $sum = 0;
        for ($i = 0; $i < count($nums); $i++) {
            $sum += $nums[$i];
            if (isset($hash[$sum - $k])) {
                $count += $hash[$sum - $k];
            }
            if (!isset($hash[$sum])) {
                $hash[$sum] = 1;
            } else {
                $hash[$sum]++;
            }
        }
        print_r($hash);
        return $count;
    }

    function test($nums, $k)
    {
        $res = [];
        $this->dfs($nums, $k, 0, [], $res);
        return $res;
    }

    function dfs($nums, $k, $level, $list, &$res)
    {
        if ($k == 0) {
            $res[] = $list;
        }
        for ($i = $level; $i < count($nums); $i++) {
            array_push($list, $nums[$i]);
            $this->dfs($nums, $k - $nums[$i], $i + 1, $list, $res);
            array_pop($list);
        }
    }

    function test2($nums, $k)
    {
        $res = [];
        $this->dfs2($nums, $k, 0, [], $res);
        return $res;
    }

    function dfs2($nums, $k, $level, $list, &$res)
    {
        if ($level == count($nums)) return;
        if ($k == 0) {
            $res[] = $list;
            return;
        }
        $this->dfs($nums, $k, $level + 1, $list, $res);
        array_push($list, $nums[$level]);
        $this->dfs($nums, $k - $nums[$level], $level + 1, $list, $res);
        array_pop($list);
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
$nums = [1, 2, 3, 3];
$k = 6;
$s = new Solution();
//$ret = $s->subarraySum3($nums, $k);
$ret = $s->test2($nums, $k);
print_r($ret);
