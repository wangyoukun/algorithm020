<?php

class Solution
{

    /**
     * 一、排序 O(NLogN) O(LogN)
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate($nums)
    {
        sort($nums);
        for ($i = 0; $i < count($nums) - 1; $i++) {
            if ($nums[$i] == $nums[$i + 1]) return true;
        }
        return false;
    }

    /**
     * 一、哈希 O(N) O(N)
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate2($nums)
    {
        $hash = [];
        for ($i = 0; $i < count($nums); $i++) {
            if (!isset($hash[$nums[$i]])) {
                $hash[$nums[$i]] = 1;
            } else {
                if (++$hash[$nums[$i]] > 1) return true;
            }
        }
        return false;
    }
}

$nums = [1, 2, 3, 1];
$nums = [1, 2, 3, 4];
$nums = [0];
//$ret = (new Solution())->containsDuplicate($nums);
$ret = (new Solution())->containsDuplicate2($nums);
var_dump($ret);