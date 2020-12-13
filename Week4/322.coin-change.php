<?php

class Solution
{

    /**
     * 一、贪心 + DFS
     * https://leetcode-cn.com/problems/coin-change/solution/322-by-ikaruga/
     * @param Integer[] $coins
     * @param Integer $amount
     * @return Integer
     */
    function coinChange($coins, $amount)
    {
        if ($amount == 0) return 0;
        rsort($coins);
        $res = PHP_INT_MAX;
        $this->dfs($coins, $amount, 0, 0, $res);
        return $res == PHP_INT_MAX ? -1 : $res;
    }

    function dfs($coins, $amount, $level, $count, &$res)
    {
        if ($amount == 0) {
            $res = min($count, $res);
            return;
        }
        if ($level == count($coins)) return;
        for ($k = floor($amount / $coins[$level]); $k >= 0 && ($k + $count) < $res; $k--) {
            $this->dfs($coins, $amount - $k * $coins[$level], $level + 1, $k + $count, $res);
        }
    }

    /**
     * 二、动态规划 自下而上 O(Sn) O(S) S金额 n是硬币数量
     * 定义状态 dp[i] 组成面值i所需的最少硬币数量
     * @param Integer[] $coins
     * @param Integer $amount
     * @return Integer
     */
    function coinChange2($coins, $amount)
    {
        if ($amount == 0) return 0;
        $max = $amount + 1;
        $dp = array_fill(0, $max, $max);
        $dp[0] = 0;
        for ($i = 0; $i <= $amount; $i++) {
            for ($j = 0; $j < count($coins); $j++) {
                if ($i >= $coins[$j]) {
                    $dp[$i] = min($dp[$i], $dp[$i - $coins[$j]] + 1);
                }
            }
        }
        return $dp[$amount] > $amount ? -1 : $dp[$amount];
    }
}

/**
 * 输入：coins = [1, 2, 5], amount = 11
 * 输出：3
 * 解释：11 = 5 + 5 + 1
 * 示例 2：
 *
 * 输入：coins = [2], amount = 3
 * 输出：-1
 * 示例 3：
 *
 * 输入：coins = [1], amount = 0
 * 输出：0
 * 示例 4：
 *
 * 输入：coins = [1], amount = 1
 * 输出：1
 * 示例 5：
 *
 * 输入：coins = [1], amount = 2
 * 输出：2
 */

$coins = [1, 2, 5];
$amount = 11;
$s = new Solution();
$ret = $s->coinChange2($coins, $amount);
print_r($ret);