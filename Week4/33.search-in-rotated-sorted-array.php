<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target)
    {
        $l = 0;
        $r = count($nums) - 1;
        while ($l <= $r) {
            $mid = $l + (($r - $l) >> 1);
            if ($nums[$mid] == $target) {
                return $mid;
            }
            //左值 <= 中值 左边有序 否则 右边有序
            if ($nums[0] <= $nums[$mid]) {
                if ($nums[$l] <= $target && $target < $nums[$mid]) {  //这个地方 target 不会等于 mid
                    $r = $mid - 1;
                } else {
                    $l = $mid + 1;
                }
            } else {
                if ($nums[$mid] < $target && $target <= $nums[$r]) {  //这个地方 target 不会等于 mid
                    $l = $mid + 1;
                } else {
                    $r = $mid - 1;
                }
            }
        }
        return -1;
    }
}

/**
 * 输入：nums = [4,5,6,7,0,1,2], target = 0
 * 输出：4
 * 输入：nums = [4,5,6,7,0,1,2], target = 3
 * 输出：-1
 */

$nums = [4, 5, 6, 7, 0, 1, 2];
$nums = [4, 5, 6, 7, 0, 1, 2];
$target = 3;
$target = 0;
$s = new Solution();
$ret = $s->search($nums, $target);
print_r($ret);