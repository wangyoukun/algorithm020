<?php

class Solution
{

    /**
     * 一、一次遍历最大值减最小值 O(N) O(1)
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices)
    {
        $maxProfit = 0;
        $minPrice = PHP_INT_MAX;
        for ($i = 0; $i < count($prices); $i++) {
            if ($prices[$i] < $minPrice) {
                $minPrice = $prices[$i];
            } elseif ($prices[$i] - $minPrice > $maxProfit) {
                $maxProfit = $prices[$i] - $minPrice;
            }
        }
        return $maxProfit;
    }

    /**
     * 二、动态规划 O(N) O(1)
     * 这是一个最大连续子数组和的问题, 区间和可以转换成求差的问题，求差问题，也可以转换成区间和的问题。求原数组中两元素的最大差等价于求差数组的最大子序和。
     * 最大连续子数组和可以使用动态规划求解， dp[i] 表示以 i 为结尾的最大连续子数组和，递推公式为：
     * dp[i] = max(diff[i], dp[i-1] + diff[i])
     *
     * 由于数组中数据是不连续的，在本题中【求导弱化为求差】，即 f'[0] = (f[1] - f[0]) / 1 - 0 = f[1] - f[0]，
     * 对【原数组】进行求导之后得到的是【差数组】。 求【原数组】的【最大差】的问题转换为求【差数组】的【最大子序和】问题。
     * 差分就是离散形式下的微分 微分就是导数
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit2($prices)
    {
        $diff = [];
        for ($i = 0; $i < count($prices) - 1; $i++) {
            $diff[$i] = $prices[$i + 1] - $prices[$i];
        }
        //print_r($diff);
        //$dp[0] = max(0, $diff[0]);
        $preSum = max(0, $diff[0]);
        $maxProfit = max(0, $diff[0]);
        for ($j = 1; $j < count($diff); $j++) {
            //$dp[$j] = max($dp[$j - 1] + $diff[$j], $diff[$j]);
            $preSum = max($preSum + $diff[$j], $diff[$j]);
            $maxProfit = max($preSum, $maxProfit);
            //$maxProfit = max($dp[$j], $maxProfit);
        }
        //print_r($dp);
        return $maxProfit;
    }
}

/**
 * 输入: [7,1,5,3,6,4]
 * 输出: 5
 * 解释: 在第 2 天（股票价格 = 1）的时候买入，在第 5 天（股票价格 = 6）的时候卖出，最大利润 = 6-1 = 5 。
 * 注意利润不能是 7-1 = 6, 因为卖出价格需要大于买入价格；同时，你不能在买入前卖出股票。
 */

$prices = [7, 1, 5, 3, 6, 4];
$ret = (new Solution())->maxProfit2($prices);
print_r($ret);