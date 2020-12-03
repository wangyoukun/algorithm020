<?php

class Solution
{

    /**
     * DFS 深度优先搜索 + 感染
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid)
    {
        $r = count($grid);
        $c = count($grid[0]);
        $num = 0;
        for ($i = 0; $i < $r; $i++) {
            for ($j = 0; $j < $c; $j++) {
                if ($grid[$i][$j] == 1) {
                    $this->dfs($grid, $i, $j);
                    $num++;
                }
            }
        }
        return $num;
    }

    function dfs(&$grid, $r, $c)
    {
        //print_r('r:' . $r . '|c:' . $c . PHP_EOL);
        //print_r($grid);
        if (!$this->inArea($grid, $r, $c)) return; //出界返回
        if ($grid[$r][$c] != 1) return; //非岛屿返回
        $grid[$r][$c] = 2; //标记感染
        $this->dfs($grid, $r - 1, $c); //向上遍历
        $this->dfs($grid, $r + 1, $c); //向下遍历
        $this->dfs($grid, $r, $c - 1); //向左遍历
        $this->dfs($grid, $r, $c + 1); //向右遍历
    }

    function inArea($grid, $r, $c)
    {
        return $r >= 0 && $r < count($grid) && $c >= 0 && $c < count($grid[0]);
    }

    /**
     * BFS 广度优先搜索 + 感染
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands2($grid)
    {
        $r = count($grid);
        $c = count($grid[0]);
        $this->visited = [];
        for ($i = 0; $i < $r; $i++) {
            for ($j = 0; $j < $c; $j++) {
                $this->visited[$i][$j] = 0;
            }
        }
        $this->direction = [[-1, 0], [0, -1], [0, 1], [1, 0]];
        $num = 0;
        for ($i = 0; $i < $r; $i++) {
            for ($j = 0; $j < $c; $j++) {
                if ($grid[$i][$j] == 1 && !$this->visited[$i][$j]) {
                    $this->bfs($grid, $i, $j, $c);
                    $num++;
                }
            }
        }
        return $num;
    }

    function bfs($grid, $r, $c, $base)
    {
        $queue = new SplQueue();
        $code = $r * $base + $c;
        $queue->enqueue($code);
        $this->visited[$r][$c] = 1;
        while (!$queue->isEmpty()) {
            $code = $queue->dequeue();
            $x = floor($code / $base);
            $y = $code % $base;
            for ($i = 0; $i < count($this->direction); $i++) {
                $newX = $x + $this->direction[$i][0];
                $newY = $y + $this->direction[$i][1];
                if ($this->inArea($grid, $newX, $newY) && $grid[$newX][$newY] && !$this->visited[$newX][$newY]) {
                    $queue->enqueue($newX * $base + $newY);
                    $this->visited[$newX][$newY] = 1;
                }
            }
        }
    }

}

$grid = [
    ["1", "1", "0"],
    ["1", "1", "0"],
    ["0", "0", "1"],
];
$grid = [
    ["1", "1", "0", "0", "0"],
    ["1", "1", "0", "0", "0"],
    ["0", "0", "1", "0", "0"],
    ["0", "0", "0", "1", "1"]
];
$s = new Solution();
$ret = $s->numIslands2($grid);
print_r($ret);