<?php

class Solution
{

    /** 一、贪心 O(N) O(1)
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices)
    {
        $res = 0;
       for($i = 1; $i < count($prices);$i++) {
           $res += max(0, $prices[$i] - $prices[$i - 1]);
       }
       return $res;
    }

    /**
     * 二、动态规划 O(N) O(N) 优化则空间复杂度O(1)
     *  定义状态 dp[i][0] 表示第 i 天交易完后手里没有股票的最大利润，
     *         dp[i][1] 表示第 i 天交易完后手里持有一支股票的最大利润（i 从 0 开始）
     * @param $prices
     * @return int|mixed
     */
    function maxProfit2($prices)
    {
        $dp = array_fill(0, count($prices), [0, 0]);
        $n = count($prices);
        $dp[0][0] = 0;
        //$dp0 = 0;
        $dp[0][1] = -$prices[0];
        //$dp1 = -$prices[0];
        for ($i = 1; $i < $n; $i++) {
            $dp[$i][0] = max($dp[$i - 1][0], $dp[$i - 1][1] + $prices[$i - 1]); // 前一天结束的时候手里持有一支股票，即 dp[i−1][1]，这时候我们要将其卖出 并增加 prices[i - 1] 的收益
            $dp[$i][1] = max($dp[$i - 1][1], $dp[$i - 1][0] - $prices[$i - 1]); // 前一天结束时还没有股票，即 dp[i−1][0]，这时候我们要将其买入，并减少 prices[i] 的收益

//            $newDp0 = max($dp0, $dp1 + $prices[$i - 1]);
//            $newDp1 = max($dp1, $dp0 - $prices[$i - 1]);
//            $dp0 = $newDp0;
//            $dp1 = $newDp1;
        }
        //print_r($dp0);
        return $dp[$n - 1][0];
    }

}

/**
 * 输入: [7,1,5,3,6,4]
 * 输出: 7
 * 解释: 在第 2 天（股票价格 = 1）的时候买入，在第 3 天（股票价格 = 5）的时候卖出, 这笔交易所能获得利润 = 5-1 = 4 。
 * 随后，在第 4 天（股票价格 = 3）的时候买入，在第 5 天（股票价格 = 6）的时候卖出, 这笔交易所能获得利润 = 6-3 = 3 。
 *
 * 输入: [1,2,3,4,5]
 * 输出: 4
 * 解释: 在第 1 天（股票价格 = 1）的时候买入，在第 5 天 （股票价格 = 5）的时候卖出, 这笔交易所能获得利润 = 5-1 = 4 。
 * 注意你不能在第 1 天和第 2 天接连购买股票，之后再将它们卖出。
 * 因为这样属于同时参与了多笔交易，你必须在再次购买前出售掉之前的股票。
 */

$prices = [1, 2, 3, 4, 5];
$prices = [7, 1, 5, 3, 6, 4];

$s = new Solution();
$ret = $s->maxProfit2($prices);
print_r($ret);
