<?php

class Solution
{

    /**
     * DFS O(MN) O(MN)
     * @param Integer[][] $grid
     * @return Integer
     */
    function islandPerimeter($grid)
    {
        $nr = count($grid);
        $nc = count($grid[0]);
        $num = 0;
        for ($i = 0; $i < $nr; $i++) {
            for ($j = 0; $j < $nc; $j++) {
                if ($grid[$i][$j] == 1) {
                    $num = $this->dfs($grid, $i, $j);
                }
            }
        }
        return $num;
    }

    function dfs(&$grid, $r, $c)
    {
        if (!$this->inArea($grid, $r, $c)) return 1; //边界
        if ($grid[$r][$c] == 0) return 1; //海洋
        if ($grid[$r][$c] == 2) return 0; //已扫描
        $grid[$r][$c] = 2;
        return
            $this->dfs($grid, $r - 1, $c)
            + $this->dfs($grid, $r + 1, $c)
            + $this->dfs($grid, $r, $c - 1)
            + $this->dfs($grid, $r, $c + 1);
    }

    function inArea($grid, $r, $c)
    {
        return $r >= 0 && $r < count($grid) && $c >= 0 && $c < count($grid[0]);
    }

    /**
     * 迭代 O(MN) O(1)
     * @param Integer[][] $grid
     * @return Integer
     */
    function islandPerimeter2($grid)
    {
        $dx = [-1, 0, 0, 1];
        $dy = [0, 1, -1, 0];
        $nr = count($grid);
        $nc = count($grid[0]);
        $num = 0;
        for ($i = 0; $i < $nr; $i++) {
            for ($j = 0; $j < $nc; $j++) {
                if ($grid[$i][$j] == 1) {
                    for ($k = 0; $k < 4; $k++) {
                        $x = $i + $dx[$k];
                        $y = $j + $dy[$k];
                        if ($x < 0 || $y < 0 || $x >= $nr || $y >= $nc || $grid[$x][$y] == 0) { //边缘或海洋
                            $num++;
                        }
                    }
                }
            }
        }
        return $num;
    }

}

$grid = [[0, 1, 0, 0], [1, 1, 1, 0], [0, 1, 0, 0], [1, 1, 0, 0]];
$s = new Solution();
$ret = $s->islandPerimeter2($grid);
print_r($ret);