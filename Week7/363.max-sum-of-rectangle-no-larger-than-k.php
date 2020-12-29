<?php

class Solution
{

    /**
     * 固定左右边界求前缀和 + 求不大于k的最大子区间和
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function maxSumSubmatrix($matrix, $k)
    {
        $row = count($matrix);
        $col = count($matrix[0]);
        $ans = PHP_INT_MIN;
        for ($l = 0; $l < $col; $l++) {
            $rowSum = array_fill(0, $row, 0);
            for ($r = $l; $r < $col; $r++) {
                for ($i = 0; $i < $row; $i++) {
                    $rowSum[$i] += $matrix[$i][$r];
                }
                $ans = max($ans, $this->dpMax($rowSum, $k));
                if ($ans == $k) return $k; // 尽量提前
            }
        }
        return $ans;
    }

    /**
     * 求不大于k的最大子区间和 二分查找
     * preSum[i,j] = preSum[0,j] - preSum[0,i] <= k
     * preSum[0,j] - k <= preSum[0,i]
     * 首先想起来前缀和求法sum[j]-sum[i]，可以理解成 大面积-小面积
     * 结合起题目来就是 大-小<=k 而稍微变化一下就是 小>=大-k
     * 我们主要找的就是符合的小面积，而且要想最逼近k，在大面积一定情况下，小面积越小越好
     * @param $arr
     * @param $k
     */
    function dpMax($arr, $k)
    {
        $preSum = 0;
        $rollMax = PHP_INT_MIN;
        for ($i = 0; $i < count($arr); $i++) {
            $preSum = max($preSum + $arr[$i], $arr[$i]);
            $rollMax = max($rollMax, $preSum);
        }
        if ($rollMax <= $k) return $rollMax;
        $ans = PHP_INT_MIN;
        for ($i = 0; $i < count($arr); $i++) {
            $preSum = 0;
            for ($j = $i; $j < count($arr); $j++) {
                $preSum += $arr[$j];
                if ($preSum > $ans && $preSum <= $k) $ans = $preSum; //更新答案
                if($ans == $k) return $k; //尽量提前
            }
        }
        return $ans;
    }
}

/**
 * 输入: matrix = [[1,0,1],[0,-2,3]], k = 2
 * 输出: 2
 * 解释:矩形区域[[0, 1], [-2, 3]]的数值和是 2，且 2 是不超过 k 的最大数字（k = 2）。
 * matrix = [[2,2,-1]], k = 0 // -1
 */

$matrix = [[1, 0, 1], [0, -2, 3]];
$k = 2;
$matrix = [[2, 2, -1]];
$k = 0;
$ret = (new Solution())->maxSumSubmatrix($matrix, $k);
print_r($ret);