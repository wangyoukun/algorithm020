<?php

class Solution
{

    /**
     * 动态规划 O(mn)  O(mn);
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n)
    {
        $tmp = array_fill(0, $m, 0);
        $dp = array_fill(0, $n, $tmp);
        $t = $m;
        while ($t >= 0) $dp[$t--][0] = 1;
        $t = $n;
        while ($t >= 0) $dp[0][$t--] = 1;
        for ($i = 1; $i < $m; $i++) {
            for ($j = 1; $j < $n; $j++) {
                $dp[$i][$j] = $dp[$i - 1][$j] + $dp[$i][$j - 1];
            }
        }
        return $dp[$m - 1][$n - 1];
    }

    /**
     * 动态规划 O(mn)  O(min(m,n));
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths2($m, $n)
    {
        $dp = array_fill(0, $n, 1);
        for ($i = 1; $i < $m; $i++) {
            for ($j = 1; $j < $n; $j++) {
                $dp[$j] += $dp[$j - 1];
            }
        }
        print_r($dp);
        return $dp[$n - 1];
    }

    /**
     * 组合数学 O(mn)  O(min(m,n));
     * 我们要想到达终点，需要往下走n-1步，往右走m-1步，总共需要走n+m-2步。他无论往右走还是往下走他的总的步数是不会变的。
     * 也就相当于总共要走n+m-2步，往右走m-1步总共有多少种走法，很明显这就是一个排列组合问题
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths3($m, $n)
    {
        $N = $m + $n - 2;
        $ans = 1;
        for ($i = 1; $i < $m; $i++) {
            $ans *= ($N - ($m - 1) + $i) / $i;
        }
        return $ans;
    }

}

/**
 * 输入：m = 3, n = 2
 * 输出：3
 * 解释：
 * 从左上角开始，总共有 3 条路径可以到达右下角。
 * 1. 向右 -> 向右 -> 向下
 * 2. 向右 -> 向下 -> 向右
 * 3. 向下 -> 向右 -> 向右
 *
 * 输入：m = 7, n = 3
 * 输出：28
 *
 * 输入：m = 3, n = 3
 * 输出：6
 */

$m = 7;
$n = 3;
$s = new Solution();
$ret = $s->uniquePaths3($m, $n);
print_r($ret);