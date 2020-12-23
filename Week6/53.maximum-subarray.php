<?php

class Solution
{

    /**
     * 一、动态规划求解最大连续子数组和 O(N) O(1)
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums)
    {
        $preSum = $ans = $nums[0];
        for ($i = 1; $i < count($nums); $i++) {
            $preSum = max($preSum + $nums[$i], $nums[$i]);
            $ans = max($preSum, $ans);
        }
        return $ans;
    }

    /**
     * 二、分治 O(N) O(LogN)
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray2($nums)
    {
        return $this->get($nums, 0, count($nums) - 1)[2];
    }

    /**
     * 求a序列任意区间[l,r]最大子序列和
     * @param $a
     * @param $l
     * @param $r
     * lSum 表示 [l, r][l,r] 内以 ll 为左端点的最大子段和
     * rSum 表示 [l, r][l,r] 内以 rr 为右端点的最大子段和
     * mSum 表示 [l, r][l,r] 内的最大子段和
     * iSum 表示 [l, r][l,r] 的区间和
     * return [lSum rSum mSum iSum]
     */
    function get($a, $l, $r)
    {
        if ($l == $r) {
            return [$a[$l], $a[$l], $a[$l], $a[$l]];
        }
        $mid = $l + (($r - $l) >> 1);
        $lSub = $this->get($a, $l, $mid);
        $rSub = $this->get($a, $mid + 1, $r);
        return $this->pushUp($lSub, $rSub);
    }

    function pushUp($lSub, $rSub)
    {
        return [
         max($lSub[0],$lSub[3] + $rSub[0]),
         max($rSub[1],$rSub[3] + $lSub[1]),
         max($lSub[2],$rSub[2],$lSub[1] + $rSub[0]),
         $lSub[3] + $rSub[3],
        ];
    }

}

/**
 * 输入: [-2,1,-3,4,-1,2,1,-5,4]
 * 输出: 6
 * 解释: 连续子数组 [4,-1,2,1] 的和最大，为 6。
 */

$nums = [-2, 1, -3, 4, -1, 2, 1, -5, 4]; //6
$nums = [1,2,-1,-2,2,1,-2,1]; //3
$s = new Solution();
$ret = $s->maxSubArray2($nums);
print_r($ret);