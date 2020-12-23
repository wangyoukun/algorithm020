<?php

class Solution
{

    /**
     * 动态规划 O(N) O(1)
     * 这里最大子区间乘积和最大子区间和不同的地方是 由于最大数乘以一个负数可能会变成最小数
     * 所以要维护 当前值 最大值 最小值 3个变量 从这3个变量中求解
     * @param Integer[] $nums
     * @return Integer
     */
    function maxProduct($nums)
    {
        $ans = $min = $max = $nums[0];
        for ($i = 1; $i < count($nums); $i++) {
            $ma = $max;
            $mi = $min;
            $min = min(min($nums[$i], $ma * $nums[$i]), $mi * $nums[$i]);
            $max = max(max($nums[$i], $mi * $nums[$i]), $ma * $nums[$i]);
            $ans = max($ans, $max);
        }
        return $ans;
    }
}

$nums = [2, 3, -2, 4]; //6
$nums = [0, 2]; //2 这就是为啥要维护当前值 而不是只维护最大值,最小值
$ret = (new Solution())->maxProduct($nums);
print_r($ret);
