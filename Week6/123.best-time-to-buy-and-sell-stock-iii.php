<?php

class Solution
{

    /**
     * 一、动态规划
     * 定义状态转移数组dp[天数i][当前是否持股0|1][当前已经卖出的次数0|1|2]
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices)
    {
        $dp[0][0][0] = 0;
        $dp[0][0][1] = PHP_INT_MIN;
        $dp[0][0][2] = PHP_INT_MIN;
        $dp[0][1][0] = -$prices[0];
        $dp[0][1][1] = PHP_INT_MIN;
        $dp[0][1][2] = PHP_INT_MIN;
        $n = count($prices);
        for ($i = 1; $i < $n; $i++) {
            //1.未持股 卖出0次: 则未进行过买卖 利润为0
            $dp[$i][0][0] = 0;
            //2.未持股 卖过1次：昨天就是这个状态 或者 可能今天卖出一次 (昨天持股 今天卖一次)
            $dp[$i][0][1] = max($dp[$i - 1][0][1], $dp[$i - 1][1][0] + $prices[$i]);
            //3.未持股 卖过2次：昨天就是这个状态 或者 可能今天卖出一次 (昨天持股 今天卖一次)
            $dp[$i][0][2] = max($dp[$i - 1][0][2], $dp[$i - 1][1][1] + $prices[$i]);
            //4.已持股 卖出0次: 昨天就是这个状态 或者 可能今天买入一次 (昨天未持股 今天买一次 持股了)
            $dp[$i][1][0] = max($dp[$i - 1][1][0], $dp[$i - 1][0][0] - $prices[$i]);
            //5.已持股 卖出1次: 昨天就是这个状态 或者 可能今天买入一次 (昨天未持股 今天买一次 持股了)
            $dp[$i][1][1] = max($dp[$i - 1][1][1], $dp[$i - 1][0][1] - $prices[$i]);
            //6.已持股 卖出2次: 最多交易2次 这种情况不存在 （已经卖2次了 就不能持股了）
            $dp[$i][1][2] = PHP_INT_MIN;
        }
        //未持股的利润肯定高于持股时的利润 所以从 未持股卖1次 未持股卖2次 0(全是递减时只要买肯定亏 所以不动就是盈利) 取最大值
        return max($dp[$n - 1][0][1], $dp[$n - 1][0][2], 0);
    }

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit2($prices)
    {
        $s1 = -$prices[0]; //第一天 将股票买入
        $s2 = PHP_INT_MIN;
        $s3 = PHP_INT_MIN;
        $s4 = PHP_INT_MIN;
        for ($i = 1; $i < count($prices); $i++) {
            $s1 = max($s1, -$prices[$i]); //买入价格更低的股票
            $s2 = max($s2, $s1 + $prices[$i]); //卖出 或者 不动
            $s3 = max($s3, $s2 - $prices[$i]); //买入 或者 不动
            $s4 = max($s4, $s3 + $prices[$i]); //卖出 或者 不动
        }
        return max($s4, 0);
    }

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit3($prices)
    {
        /*
        定义四个变量分别记录第i天，第一次买和卖的最大收益，第二次买和卖的最大收益。
        遍历一次，每一天都尝试买卖如果有收益，就更新(操作)。
        注意：+ -price可以理解为入账和出账。
        */
        $oneBuy = $twoBuy = PHP_INT_MIN;
        $oneSell = $twoSell = 0;
        foreach ($prices as $price) {
            $oneBuy = max($oneBuy, -$price);
            $oneSell = max($oneSell, $oneBuy + $price);
            $twoBuy = max($twoBuy, $oneSell - $price);
            $twoSell = max($twoSell, $twoBuy + $price);
        }

        return $twoSell;
    }
}

/**
 * 输入: [3,3,5,0,0,3,1,4]
 * 输出: 6
 * 解释: 在第 4 天（股票价格 = 0）的时候买入，在第 6 天（股票价格 = 3）的时候卖出，这笔交易所能获得利润 = 3-0 = 3 。
 *     随后，在第 7 天（股票价格 = 1）的时候买入，在第 8 天 （股票价格 = 4）的时候卖出，这笔交易所能获得利润 = 4-1 = 3 。
 *
 * 输入: [1,2,3,4,5]
 * 输出: 4
 * 解释: 在第 1 天（股票价格 = 1）的时候买入，在第 5 天 （股票价格 = 5）的时候卖出, 这笔交易所能获得利润 = 5-1 = 4 。
 * 注意你不能在第 1 天和第 2 天接连购买股票，之后再将它们卖出。
 * 因为这样属于同时参与了多笔交易，你必须在再次购买前出售掉之前的股票。
 *
 * 输入: [7,6,4,3,1]
 * 输出: 0
 * 解释: 在这个情况下, 没有交易完成, 所以最大利润为 0。
 */

$prices = [3, 3, 5, 0, 0, 3, 1, 4]; //6
$ret = (new Solution())->maxProfit($prices);
print_r($ret);