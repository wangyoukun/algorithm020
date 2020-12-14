<?php

class Solution
{

    /**
     * 一、贪心 反向查找 O(N^2) O(1) 超时
     * @param Integer[] $nums
     * @return Integer
     */
    function jump2($nums)
    {
        $n = count($nums);
        $position = $n - 1;
        $step = 0;
        while ($position > 0) {
            for ($i = 0; $i < $n; $i++) {
                if ($i + $nums[$i] >= $position) {
                    $step++;
                    $position = $i;
                    break;
                }
            }
        }
        return $step;
    }

    /**
     * 一、贪心 正向查找 O(N) O(1)
     * @param Integer[] $nums
     * @return Integer
     */
    function jump($nums)
    {
        $n = count($nums);
        $masPosition = 0;
        $end = 0; //最大位置下标
        $step = 0;
        for ($i = 0; $i < $n - 1; $i++) { //注意不访问最后一个位置
            $masPosition = max($masPosition, $i + $nums[$i]);
            if ($i == $end) {
                $step++;
                $end = $masPosition;
            }
        }
        return $step;
    }
}

/**
 * 输入: [2,3,1,1,4]
 * 输出: 2
 * 解释: 跳到最后一个位置的最小跳跃数是 2。
 * 从下标为 0 跳到下标为 1 的位置，跳1步，然后跳3步到达数组的最后一个位置。
 */
$nums = [2, 3, 1, 1, 4];
$s = new Solution();
$ret = $s->jump($nums);
print_r($ret);