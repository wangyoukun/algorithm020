<?php

class Solution
{

    /**
     *
     * 考虑这个插入的位置 pos，它成立的条件为：
     * nums[pos−1] <target ≤ nums[pos]
     * 其中 nums 代表排序数组。由于如果存在这个目标值，我们返回的索引也是 pos，因此我们可以将两个条件合并得出最后的目标：「在一个有序数组中找第一个大于等于 target 的下标」
     * 找右边界
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function searchInsert($nums, $target)
    {
        $pos = $this->searchRightBorder($nums, $target);
        return $pos;
    }

    function searchRightBorder($nums, $target)
    {
        $l = 0;
        $r = count($nums) - 1;
        $ans = count($nums);
        while ($l <= $r) {
            $mid = $l + (($r - $l) >> 1);
            if ($target <= $nums[$mid]) {
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
 *
 * 输入: [1,3,5,6], 5
 * 输出: 2
 * 输入: [1,3,5,6], 2
 * 输出: 1
 * 输入: [1,3,5,6], 7
 * 输出: 4
 * 输入: [1,3,5,6], 0
 * 输出: 0
 *
 */
$nums = [1, 3, 5, 6];
$target = 7;
$s = new Solution();
$ret = $s->searchInsert($nums, $target);
print_r($ret);