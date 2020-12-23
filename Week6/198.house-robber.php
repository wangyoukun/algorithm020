<?php

class Solution
{

    /**
     * 动态规划 O(N) O(n)
     * dp[i] 表示前 i 间房屋能偷窃到的最高总金额
     * dp[0] = nums[0]
     * dp[1] = max(nums[0],nums[1])
     * dp[i] = max(dp[i] + dp[i-2],dp[i-1])
     * @param Integer[] $nums
     * @return Integer
     */
    function rob($nums)
    {
        $n = count($nums);
        if ($n == 0) return 0;
        if ($n == 1) return $nums[0];
        $dp[0] = $nums[0];
        $dp[1] = max($nums[0], $nums[1]);
        for ($i = 2; $i < $n; $i++) {
            $dp[$i] = max($nums[$i] + $dp[$i - 2], $dp[$i - 1]);
        }
        return $dp[$n - 1];
    }

    /**
     * 动态规划 O(N) O(1)
     * @param Integer[] $nums
     * @return Integer
     */
    function rob2($nums)
    {
        $n = count($nums);
        if ($n == 0) return 0;
        if ($n == 1) return $nums[0];
        $dp0 = $nums[0];
        $dp1 = max($nums[0], $nums[1]);
        for ($i = 2; $i < $n; $i++) {
            $temp = $dp1;
            $dp1 = max($nums[$i] + $dp0, $dp1);
            $dp0 = $temp;
        }
        return $dp1;
    }
}

$nums = [1, 2, 3, 1]; //4
$nums = [2, 7, 9, 3, 1]; //12
$ret = (new Solution())->rob2($nums);
print_r($ret);
