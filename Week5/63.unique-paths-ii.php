<?php

class Solution
{

    /**
     * 一、动态规划 O(MN) O(NM)
     * @param Integer[][] $obstacleGrid
     * @return Integer
     */
    function uniquePathsWithObstacles($obstacleGrid)
    {
        $row = count($obstacleGrid);
        $col = count($obstacleGrid[0]);
        $tmp = array_fill(0, $row, 0);
        $dp = array_fill(0, $col, $tmp);
        //首列 base
        $flag = 1;
        for ($i = 0; $i < $row; $i++) {
            if ($obstacleGrid[$i][0] == 1) {
                $flag = 0;
            }
            $dp[$i][0] = $flag;
        }
        //首行 base
        $flag = 1;
        for ($i = 0; $i < $col; $i++) {
            if ($obstacleGrid[0][$i] == 1) {
                $flag = 0;
            }
            $dp[0][$i] = $flag;
        }
        //非首行首列 直接
        for ($i = 1; $i < $row; $i++) {
            for ($j = 1; $j < $col; $j++) {
                if ($obstacleGrid[$i][$j] == 0) {
                    $dp[$i][$j] = $dp[$i - 1][$j] + $dp[$i][$j - 1];
                }
            }
        }
        //print_r($dp);
        return $dp[$row - 1][$col -1];
    }

    /**
     * 二、动态规划 + 滚动数组 O(MN) O(min(m,n))
     * @param Integer[][] $obstacleGrid
     * @return Integer
     */
    function uniquePathsWithObstacles2($obstacleGrid)
    {
        $row = count($obstacleGrid);
        $col = count($obstacleGrid[0]);
        $dp = array_fill(0, $col, 0);

        $dp[0] = $obstacleGrid[0][0] == 0 ? 1 : 0;
        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $col; $j++) {
                if ($obstacleGrid[$i][$j] == 1) {
                    $dp[$j] = 0;
                    continue;
                }
                if ($j > 0 && $obstacleGrid[$i][$j - 1] == 0)
                    $dp[$j] += $dp[$j - 1];
            }
        }
        return $dp[$col - 1];
    }
}

/**
 *输入：obstacleGrid = [[0,0,0],[0,1,0],[0,0,0]]
 * 输出：2
 * 解释：
 * 3x3 网格的正中间有一个障碍物。
 * 从左上角到右下角一共有 2 条不同的路径：
 * 1. 向右 -> 向右 -> 向下 -> 向下
 * 2. 向下 -> 向下 -> 向右 -> 向右
 */

$obstacleGrid = [[0, 0, 1], [0, 0, 0], [1, 0, 0]];
$obstacleGrid = [[0, 1], [0, 0]]; //1
$obstacleGrid = [[0, 0, 0], [0, 1, 0], [0, 0, 0]]; //2
$obstacleGrid = [[0,1]]; //0
$s = new Solution();
$ret = $s->uniquePathsWithObstacles2($obstacleGrid);
print_r($ret);