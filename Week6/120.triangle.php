<?php

class Solution
{

    /**
     * 一、动态规划 O(N^2) O(N^2)
     * dp[i][j] 表示从点 (i, j) 到底边的最小路径和。
     * dp[i][j] = min(dp[i+1][j], dp[i+1][j+1]) + triangle[i][j]
     * @param Integer[][] $triangle
     * @return Integer
     */
    function minimumTotal($triangle)
    {
        $n = count($triangle);
        $dp = array_fill(0, $n, []);
        for ($i = $n - 1; $i >= 0; $i--) {
            for ($j = 0; $j <= $i; $j++) {
                if ($i == $n - 1) {
                    $dp[$i][$j] = $triangle[$i][$j];
                } else {
                    $dp[$i][$j] = $triangle[$i][$j] + min($dp[$i + 1][$j], $dp[$i + 1][$j + 1]);
                }
            }
        }
        return $dp[0][0];
    }

    /**
     * 二、动态规划 O(N^2) O(N)
     * dp[j] 表示从点 (i, j) 到底边的最小路径和。
     * dp[j] = min(dp[j], dp[j+1]) + triangle[i][j]
     * @param Integer[][] $triangle
     * @return Integer
     */
    function minimumTotal2($triangle)
    {
        $n = count($triangle);
        $dp = [];
        for ($i = $n - 1; $i >= 0; $i--) {
            for ($j = 0; $j <= $i; $j++) {
                if ($i == $n - 1) {
                    $dp[$j] = $triangle[$i][$j];
                } else {
                    $dp[$j] = $triangle[$i][$j] + min($dp[$j], $dp[$j + 1]);
                }
            }
        }
        return $dp[0];
    }
}

/**
 *例如，给定三角形：
 *
 * [
 *     [2],
 *    [3,4],
 *   [6,5,7],
 *  [4,1,8,3]
 * ]
 * 自顶向下的最小路径和为11（即，2+3+5+1= 11）。
 */

$triangle =
    [
        [2],
        [3, 4],
        [6, 5, 7],
        [4, 1, 8, 3]
    ];
$ret = (new Solution())->minimumTotal2($triangle);
print_r($ret);