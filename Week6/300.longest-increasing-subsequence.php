<?php

class Solution
{

    /**
     * 一、动态规划 O(N^2) O(n)
     * @param Integer[] $nums
     * @return Integer
     */
    function lengthOfLIS($nums)
    {
        $n = count($nums);
        $dp = array_fill(0, $n, 1);
        $ans = 1;
        for ($i = 1; $i < $n; $i++) {
            for ($j = 0; $j < $i; $j++) {
                if ($nums[$j] < $nums[$i]) {
                    $dp[$i] = max($dp[$i], $dp[$j] + 1);
                }
            }
            $ans = max($ans, $dp[$i]);
        }
        return $ans;
    }

    /**
     * 二、贪心 + 二分查找 O(nLogN) O(n)
     * 考虑一个简单的贪心，如果我们要使上升子序列尽可能的长，则我们需要让序列上升得尽可能慢，因此我们希望每次在上升子序列最后加上的那个数尽可能的小。
     * 基于上面的贪心思路，我们维护一个数组 d[i] ，表示长度为 i 的最长上升子序列的末尾元素的最小值
     * @param Integer[] $nums
     * @return Integer
     */
    function lengthOfLIS2($nums)
    {
        $n = count($nums);
        $end = 0;
        $tail = [$nums[0]]; //长度为1的最长子序列末尾元素的的最小值
        for ($i = 1; $i < $n; $i++) {
            if ($nums[$i] > $tail[$end]) {
                $tail[++$end] = $nums[$i];
            } else {
                $l = 0;
                $r = $end;
                $pos = 0;
                while ($l <= $r) {
                    $mid = $l + (($r - $l) >> 1);
                    if ($nums[$i] > $tail[$mid]) { //查找右边界
                        $l = $mid + 1;
                        print_r('L:' . $l . '|R:' . $r . '|m:' . $mid . PHP_EOL);
                        $pos = $l;
                    } else {
                        $r = $mid - 1;
                    }
                }
                $tail[$pos] = $nums[$i];
            }
            print_r($tail);
        }
        return $end + 1;
    }
}

/**
 *输入：nums = [10,9,2,5,3,7,101,18]
 * 输出：4
 * 解释：最长递增子序列是 [2,3,7,101]，因此长度为 4 。
 */
$nums = [10, 9, 2, 5, 3, 7, 101, 18];
$s = new Solution();
$ret = $s->lengthOfLIS2($nums);
print_r($ret);