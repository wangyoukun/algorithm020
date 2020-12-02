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
            if ($nums[$mid] > $target || ($lower && $nums[$mid] == $target)) {
                $r = $mid - 1;
                $ans = $mid;
            } else {
                $l = $mid + 1;
            }
        }
        return $ans;
    }

    /**
     * 寻找左边界
     * @param $nums
     * @param $target
     */
    function findLeftBorder($nums, $target)
    {
        $left = 0;
        $right = count($nums) - 1;
        $leftBorder = -1;
        while ($left <= $right) {
            $mid = $left + (($right - $left) >> 1);
            print_r('L:' . $left . '|R:' . $right . '|m:' . $mid . PHP_EOL);
            if ($nums[$mid] >= $target) {
                $right = $mid - 1;
                $leftBorder = $right;
                print_r('LB:' . $leftBorder . PHP_EOL);
            } else {
                $left = $mid + 1;
            }
        }
        return $leftBorder;
    }

    /**
     * 寻找右边界
     * @param $nums
     * @param $target
     */
    function findRightBorder($nums, $target)
    {
        $left = 0;
        $right = count($nums) - 1;
        $rightBorder = -1;
        while ($left <= $right) {
            $mid = $left + (($right - $left) >> 1);
            if ($nums[$mid] <= $target) {
                $left = $mid + 1;
                $rightBorder = $left;
            } else {
                $right = $mid - 1;
            }
        }
        return $rightBorder;
    }

    /**
     * O(LogN) O(1)
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function searchRange2($nums, $target)
    {
        $leftIdx = $this->findLeftBorder($nums, $target);
        $rightIdx = $this->findRightBorder($nums, $target);
        if ($leftIdx == -1 && $rightIdx == -1) return [-1, -1];
        if ($leftIdx <= $rightIdx && $nums[$leftIdx + 1] == $target && $nums[$rightIdx - 1] == $target) {
            return [$leftIdx + 1, $rightIdx - 1];
        }
        return [-1, -1];
    }
}

/**
 * 输入：nums = [5,7,7,8,8,10], target = 8
 * 输出：[3,4]
 */

$nums = [1, 2, 2, 3];
$target = 2;
$nums = [1];
$target = 1;
$nums = [5, 7, 7, 9, 9, 10];
$target = 8;
$s = new Solution();
//$ret = $s->searchRange2($nums, $target);
//print_r($ret);
$retL = $s->findLeftBorder($nums, $target);
$retR = $s->findRightBorder($nums, $target);
print_r([$retL,$retR]);
