<?php

class Solution
{

    /**
     * O(LogN) O(1)
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function searchRange($nums, $target)
    {
        $leftIdx = $this->binarySearch($nums, $target, true);
        $rightIdx = $this->binarySearch($nums, $target, false) - 1;
        if ($leftIdx <= $rightIdx && $rightIdx < count($nums) && $nums[$leftIdx] == $target && $nums[$rightIdx] == $target) {
            return [$leftIdx, $rightIdx];
        }
        return [-1, -1];
    }

    function binarySearch($nums, $target, $lower = false)
    {
        $l = 0;
        $r = count($nums) - 1;
        $ans = count($nums);  //当nums只有一个数时且就找这个数
        while ($l <= $r) {
            $mid = $l + (($r - $l) >> 2);
            if ($nums[$mid] > $target || ($lower && $nums[$mid] >= $target)) {
                $r = $mid - 1;
                $ans = $mid;
            } else {
                $l = $mid + 1;
            }
        }
        return $ans;
    }
}

/**
 * 输入：nums = [5,7,7,8,8,10], target = 8
 * 输出：[3,4]
 */

$nums = [5, 7, 7, 8, 8, 10];
$target = 8;
$nums = [1];
$target = 1;
$s = new Solution();
$ret = $s->searchRange($nums, $target);
print_r($ret);