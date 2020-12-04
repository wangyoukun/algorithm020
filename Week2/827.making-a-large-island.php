<?php

class Solution
{

    /** O(N^2) O(N^2)
     * @param Integer[][] $grid
     * @return Integer
     */
    function largestIsland($grid)
    {
        $nr = count($grid);
        $nc = count($grid[0]);
        $areaMap = [0, 0, 0];
        $color = 2;
        for ($i = 0; $i < $nr; $i++) {
            for ($j = 0; $j < $nc; $j++) {
                if ($grid[$i][$j] == 1) {
                    //$areaMap[$color] = $this->bfs($grid, $i, $j, $nc, $color);
                    $areaMap[$color] = $this->dfs($grid, $i, $j, $color);
                    $color++;
                }
            }
        }
        //如果全是陆地
        if (max($areaMap) == $nr * $nc) {
            return $nr * $nc;
        }
        //遍历所有海洋 将其填充成陆地 再 加上周围其他陆地的面积 求出最大的一个
        $maxArea = 1;
        $dr = [[-1, 0], [0, -1], [1, 0], [0, 1]];
        for ($i = 0; $i < $nr; $i++) {
            for ($j = 0; $j < $nc; $j++) {
                $colorMap = [];
                $area = 1;
                if ($grid[$i][$j] == 0) {
                    for ($k = 0; $k < count($dr); $k++) {
                        $nx = $i + $dr[$k][0];
                        $ny = $j + $dr[$k][1];
                        if ($this->inArea($grid, $nx, $ny) && $grid[$nx][$ny] > 0 && !in_array($grid[$nx][$ny], $colorMap)) {
                            $colorMap[] = $grid[$nx][$ny];
                            $area += $areaMap[$grid[$nx][$ny]];
                        }
                    }
                    $maxArea = max($maxArea, $area);
                }
            }
        }
        return $maxArea;
    }

    /**
     * 深度优先搜索 染色 + 计算面积
     * @param $grid
     * @param $r
     * @param $c
     * @param $color
     */
    function dfs(&$grid, $r, $c, $color)
    {
        if (!$this->inArea($grid, $r, $c)) return 0;
        if ($grid[$r][$c] == 0) return 0;
        $grid[$r][$c] = $color;
        return 1
            + $this->dfs($grid, $r + 1, $c, $color)
            + $this->dfs($grid, $r - 1, $c, $color)
            + $this->dfs($grid, $r, $c + 1, $color)
            + $this->dfs($grid, $r, $c - 1, $color);
    }

    /**
     * 广度优先搜索 染色 + 计算面积
     * @param $grid
     * @param $r
     * @param $c
     * @param $color
     */
    function bfs(&$grid, $r, $c, $base, $color)
    {
        $dr = [[-1, 0], [0, -1], [1, 0], [0, 1]];
        $queue = new SplQueue();
        $queue->enqueue($r * $base + $c);
        $grid[$r][$c] = $color;
        $area = 1;
        while (!$queue->isEmpty()) {
            $code = $queue->dequeue();
            $x = floor($code / $base);
            $y = $code % $base;
            for ($k = 0; $k < count($dr); $k++) {
                $nx = $x + $dr[$k][0];
                $ny = $y + $dr[$k][1];
                if ($this->inArea($grid, $nx, $ny) && $grid[$nx][$ny] == 1) {
                    $queue->enqueue($nx * $base + $ny);
                    $grid[$nx][$ny] = $color;
                    $area++;
                }
            }
        }
        return $area;
    }

    function inArea($grid, $r, $c)
    {
        return $r >= 0 && $r < count($grid) && $c >= 0 && $c < count($grid[0]);
    }
}

$grid = [[1, 0], [0, 1]];
$s = new Solution();
$ret = $s->largestIsland($grid);
print_r($ret);