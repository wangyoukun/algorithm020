<?php

class Solution
{

    /**
     * O(LogN) O(1)
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target)
    {
        $l = 0;
        $r = count($nums) - 1;
        $ans = -1;
        while ($l <= $r) {
            $mid = $l + (($r - $l) >> 1);
            if ($nums[$mid] == $target) {
                return $mid;
            } elseif ($nums[$mid] < $target) {
                $l = $mid + 1;
            } else {
                $r = $mid - 1;
            }
        }
        return $ans;
    }
}

/**
 *输入: nums = [-1,0,3,5,9,12], target = 9
 * 输出: 4
 */

$nums = [-1, 0, 3, 5, 9, 12];
$target = 9;
$s = new Solution();
$ret = $s->search($nums, $target);
print_r($ret);