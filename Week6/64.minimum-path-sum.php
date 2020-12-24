<?php

class Solution
{

    /**
     * 一、动态规划 O(mn) (mn) 可以优化O(min(m,n))
     * @param Integer[][] $grid
     * @return Integer
     */
    function minPathSum($grid)
    {
        $row = count($grid);
        $col = count($grid[0]);
        $tmp = array_fill(0, $col, 0);
        $dp = array_fill(0, $row, $tmp);
        $dp[0][0] = $grid[0][0];
        for ($i = 1; $i < $row; $i++) {
            $dp[$i][0] = $dp[$i - 1][0] + $grid[$i][0];
        }
        for ($j = 1; $j < $col; $j++) {
            $dp[0][$j] = $dp[0][$j - 1] + $grid[0][$j];
        }
        for ($i = 1; $i < $row; $i++) {
            for ($j = 1; $j < $col; $j++) {
                $dp[$i][$j] += min($dp[$i - 1][$j], $dp[$i][$j - 1]) + $grid[$i][$j];
            }
        }
        return $dp[$row - 1][$col - 1];
    }
}

$grid = [[1, 3, 1], [1, 5, 1], [4, 2, 1]]; //7
$grid = [[1, 2, 3], [4, 5, 6]]; //12
$ret = (new Solution())->minPathSum($grid);
print_r($ret);