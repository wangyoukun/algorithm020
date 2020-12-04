<?php

class Solution
{

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function maxAreaOfIsland($grid)
    {
        $nr = count($grid);
        $nc = count($grid[0]);
        $maxArea = 0;
        for ($i = 0; $i < $nr; $i++) {
            for ($j = 0; $j < $nc; $j++) {
                if ($grid[$i][$j] == 1) {
                    $maxArea = max($maxArea, $this->dfs($grid, $i, $j));
                }
            }
        }
        return $maxArea;
    }

    function dfs(&$grid, $r, $c)
    {
        if (!$this->inArea($grid, $r, $c)) return 0;
        if ($grid[$r][$c] != 1) return 0;
        $grid[$r][$c] = 2;
        return 1
            + $this->dfs($grid, $r - 1, $c)
            + $this->dfs($grid, $r + 1, $c)
            + $this->dfs($grid, $r, $c - 1)
            + $this->dfs($grid, $r, $c + 1);
    }

    function inArea($grid, $r, $c)
    {
        return $r >= 0 && $r < count($grid) && $c >= 0 && $c < count($grid[0]);
    }
}

$grid = [[0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
    [0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0],
    [0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0]];

$s = new Solution();
$ret = $s->maxAreaOfIsland($grid);
print_r($ret);

