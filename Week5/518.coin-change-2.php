<?php

class Solution
{

    /**
     * O(N * amount) O(N * amount)
     * https://leetcode-cn.com/problems/coin-change-2/solution/ling-qian-dui-huan-iihe-pa-lou-ti-wen-ti-dao-di-yo/
     * 正确的子问题定义应该是，problem(k,i) = problem(k-1, i) + problem(k, i-k)
     * 用前k的硬币凑齐金额i，要分为两种情况开率，一种是没有用前k-1个硬币就凑齐了，一种是前面已经凑到了i-k，现在就差第k个硬币了。
     * 状态数组就是DP[k][i], 即前k个硬币凑齐金额i的组合数。
     * 这里不再是一维数组，而是二维数组。第一个维度用于记录当前组合有没有用到硬币k，第二个维度记录现在凑的金额是多少？如果没有第一个维度信息，当我们凑到金额i的时候，我们不知道之前有没有用到硬币k。
     * 因为这是个组合问题，我们不关心硬币使用的顺序，而是硬币有没有被用到。是否使用第k个硬币受到之前情况的影响。
     * @param Integer $amount
     * @param Integer[] $coins
     * @return Integer
     */
    function change($amount, $coins)
    {
        $k = count($coins);
        $tmp = array_fill(0, $amount + 1, 0);
        $dp = array_fill(0, $k + 1, $tmp);
        $t = $k;
        while ($t >= 0) $dp[$t--][0] = 1;
        for ($i = 1; $i <= $amount; $i++) {
            for ($j = 1; $j <= $k; $j++) {
                if ($i >= $coins[$j - 1]) {
                    $dp[$j][$i] = $dp[$j - 1][$i] + $dp[$j][$i - $coins[$j - 1]];
                } else {
                    $dp[$j][$i] = $dp[$j - 1][$i];
                }
            }
        }
        return $dp[$k][$amount];
    }

    /**
     * 此时的子问题是，对于硬币从0到k，我们必须使用第k个硬币的时候，当前金额的组合数。
     * 因此状态数组DP[i]表示的是对于第k个硬币能凑的组合数
     * 状态转移方程如下
     * DP[[i] = DP[i] + DP[i-k]
     * 我们这里定义的子问题是，必须选择第k个硬币时，凑成金额i的方案。如果内外循环交换了，我们的子问题就变了，那就是对于金额i, 我们选择硬币的方案。
     * @param $amount
     * @param $coins
     * @return mixed
     */
    function change2($amount, $coins)
    {
        $k = count($coins);
        $dp = array_fill(0, $amount + 1, 0);
        $dp[0] = 1;
//        for ($j = 0; $j < $k; $j++) {
//            for ($i = 1; $i <= $amount; $i++) {
//                if ($i < $coins[$j]) continue;
//                $dp[$i] += $dp[$i - $coins[$j]];
//            }
//        }
        foreach ($coins as $coin) {
            //优化循环，减少数组索引访问
            for ($i = $coin; $i <= $amount; $i++) {
                $dp[$i] += $dp[$i - $coin];
            }
        }
        print_r($dp);
        return $dp[$amount];
    }

    /**
     * https://leetcode-cn.com/problems/coin-change-2/solution/c-bei-bao-wen-ti-by-yizhe-shi/
     * @param $amount
     * @param $coins
     * @return array
     */
    function change3($amount, $coins)
    {
        $res = [];
        $k = count($coins);
        $this->dfs($coins, $amount, 0, [], $res);
        return $res;
    }

    function dfs($coins, $amount, $level, $path, &$res)
    {
        if ($amount == 0) {
            $res[] = $path;
            return;
        }
        for ($i = 0; $i < count($coins); $i++) {
            if ($coins[$i] <= $amount) {
                array_push($path, $coins[$i]);
                $this->dfs($coins, $amount - $coins[$i], $level + 1, $path, $res);
                array_pop($path);
            }
        }
    }
}

/**
 *输入: amount = 5, coins = [1, 2, 5]
 * 输出: 4
 * 解释: 有四种方式可以凑成总金额:
 * 5=5
 * 5=2+2+1
 * 5=2+1+1+1
 * 5=1+1+1+1+1
 */

$amount = 4;
$coins = [1, 2, 3];
$amount = 5;
$coins = [1, 2, 5];
$s = new Solution();
$ret = $s->change3($amount, $coins);
print_r($ret);