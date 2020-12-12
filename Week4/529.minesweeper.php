<?php

class Solution
{

    /**
     * 一、DFS O(MN) O(MN)
     * @param String[][] $board
     * @param Integer[] $click
     * @return String[][]
     */
    function updateBoard($board, $click)
    {
        $x = $click[0];
        $y = $click[1];
        if ($board[$x][$y] == 'M') {
            $board[$x][$y] = 'X';
        } else {
            $this->dfs($board, $x, $y);
        }
        return $board;
    }

    function dfs(&$board, $x, $y)
    {
        $dx = [0, 1, 0, -1, 1, 1, -1, -1];
        $dy = [1, 0, -1, 0, 1, -1, 1, -1];
        $cnt = 0;
        for ($i = 0; $i < 8; $i++) {
            $nx = $x + $dx[$i];
            $ny = $y + $dy[$i];
            if (!$this->inBoard($board, $nx, $ny)) continue;
            if ($board[$nx][$ny] == 'M') {
                $cnt++;
            }
        }
        if ($cnt > 0) {
            $board[$x][$y] = (string)$cnt;
        } else {
            $board[$x][$y] = 'B';
            for ($j = 0; $j < 8; $j++) {
                $nx = $x + $dx[$j];
                $ny = $y + $dy[$j];
                if (!$this->inBoard($board, $nx, $ny) || $board[$nx][$ny] != 'E') continue;
                $this->dfs($board, $nx, $ny);
            }
        }
    }

    function inBoard($board, $x, $y)
    {
        return $x >= 0 && $y >= 0 && $x < count($board) && $y < count($board[0]);
    }

    /**
     * 二、BFS O(MN) O(MN)
     * @param String[][] $board
     * @param Integer[] $click
     * @return String[][]
     */
    function updateBoard2($board, $click)
    {
        $x = $click[0];
        $y = $click[1];
        if ($board[$x][$y] == 'M') {
            $board[$x][$y] = 'X';
        } else {
            $this->bfs($board, $x, $y);
        }
        return $board;
    }

    function bfs(&$board, $x, $y)
    {
        $visited = [];
        for ($i = 0; $i < count($board); $i++) {
            for ($j = 0; $j < count($board[0]); $j++) {
                $visited[$i][$j] = 0;
            }
        }
        $dx = [0, 1, 0, -1, 1, 1, -1, -1];
        $dy = [1, 0, -1, 0, 1, -1, 1, -1];
        $queue = new SplQueue();
        $queue->enqueue([$x, $y]);
        $visited[$x][$y] = 1;
        while (!$queue->isEmpty()) {
            list($tx, $ty) = $queue->dequeue();
            $cnt = 0;
            for ($i = 0; $i < 8; $i++) {
                $nx = $tx + $dx[$i];
                $ny = $ty + $dy[$i];
                if (!$this->inBoard($board, $nx, $ny)) continue;
                if ($board[$nx][$ny] == 'M') {
                    $cnt++;
                }
            }
            if ($cnt > 0) {
                $board[$tx][$ty] = (string)$cnt;
            } else {
                $board[$tx][$ty] = 'B';
                for ($i = 0; $i < 8; $i++) {
                    $nx = $tx + $dx[$i];
                    $ny = $ty + $dy[$i];
                    if (!$this->inBoard($board, $nx, $ny) || $board[$nx][$ny] != 'E' || $visited[$nx][$ny]) continue;  //注意BFS 多了 visited 判断
                    $queue->enqueue([$nx, $ny]);
                    $visited[$nx][$ny] = 1;
                }
            }
        }
    }
}

/**
 * 输入:
 * [['E', 'E', 'E', 'E', 'E'],
 * ['E', 'E', 'M', 'E', 'E'],
 * ['E', 'E', 'E', 'E', 'E'],
 * ['E', 'E', 'E', 'E', 'E']]
 * Click : [3,0]
 * 输出:
 * [['B', '1', 'E', '1', 'B'],
 * ['B', '1', 'M', '1', 'B'],
 * ['B', '1', '1', '1', 'B'],
 * ['B', 'B', 'B', 'B', 'B']]
 */

$borad = [
    ['E', 'E', 'E', 'E', 'E'],
    ['E', 'E', 'M', 'E', 'E'],
    ['E', 'E', 'E', 'E', 'E'],
    ['E', 'E', 'E', 'E', 'E']
];
$click = [3, 0];
$s = new Solution();
$ret = $s->updateBoard2($borad, $click);
print_r($ret);