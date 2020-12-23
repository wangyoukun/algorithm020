<?php

class Solution
{

    /**
     * 动态规划O(N) O(1)
     * @param Integer[] $nums
     * @return Integer
     */
    function rob($nums)
    {
        $n = count($nums);
        return max($this->robRange($nums, 0, $n - 2), $this->robRange($nums, 1, $n - 1));
    }

    function robRange($nums, $start, $end)
    {
        $n = count($nums);
        if ($n == 0) return 0;
        if ($n == 1) return $nums[$start];
        if ($n == 2) return max($nums[$start], $nums[$start + 1]);
        $dp0 = $nums[$start];
        $dp1 = max($nums[$start], $nums[$start + 1]);
        for ($i = $start + 2; $i <= $end; $i++) {
            $temp = $dp1;
            $dp1 = max($dp1, $nums[$i] + $dp0);
            $dp0 = $temp;
        }
        return $dp1;
    }
}

$nums = [2, 3, 2]; //3
$nums = [1, 3, 1, 3, 100]; //103
$ret = (new Solution())->rob($nums);
print_r($ret);