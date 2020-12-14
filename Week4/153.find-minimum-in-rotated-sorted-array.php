<?php

class Solution
{

    /** O(LogN) O(1)
     * @param Integer[] $nums
     * @return Integer
     */
    function findMin($nums)
    {
        //增加两个特例 只有一个元素 和 未旋转的数组
        $l = 0;
        $r = count($nums) - 1;
        if (count($nums) == 1 || $nums[$r] > $nums[0]) return $nums[0];
        while ($l <= $r) {
            $mid = $l + (($r - $l) >> 1);
            print_r('L:' . $l . '|R:' . $r . '|M:' . $mid . PHP_EOL);
            if ($nums[$mid] > $nums[$mid + 1]) return $nums[$mid + 1];
            if ($nums[$mid - 1] > $nums[$mid]) return $nums[$mid];
            if ($nums[0] <= $nums[$mid]) {
                $l = $mid + 1;
            } else {
                $r = $mid - 1;
            }
        }
        return -1;
    }

    function findMin2($nums)
    {
        $left = 0;
        $right = count($nums) - 1;
        while ($left < $right) {
            $mid = floor($left + ($right - $left) / 2);
            if ($nums[$mid] > $nums[$right]) {
                $left = $mid + 1;
            } else {
                $right = $mid;
            }
        }
        return $nums[$left];
    }

}

/**
 * 输入：nums = [3,4,5,1,2]
 * 输出：1
 * 输入：nums = [4,5,6,7,0,1,2]
 * 输出：0
 * 输入：nums = [1]
 * 输出：1
 */

$nums = [1];
$nums = [11, 13, 15, 17];
$nums = [4, 5, 6, 7, 1, 2];
$s = new Solution();
$ret = $s->findMin2($nums);
print_r($ret);