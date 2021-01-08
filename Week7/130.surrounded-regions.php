<?php
require_once '../Lib/UF.php';

class Solution
{
    /**
     * 并查集
     * @param String[][] $board
     * @return NULL
     */
    function solve2(&$board)
    {
        $row = count($board);
        $col = count($board[0]);
        $uf = new UF($row * $col + 1);
        $dummyNode = $row * $col;
        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $col; $j++) {
                if ($board[$i][$j] == 'O') {
                    //边界上的O 联通dummyNode
                    if (($i == 0 || $j == 0 || $i == $row - 1 || $j == $col - 1)) {
                        $uf->union($this->node($col, $i, $j), $dummyNode);
                    } else {
                        //非边界上的O 与其上下左右的O 联通
                        if ($i > 0 && $board[$i - 1][$j] == 'O') {
                            $uf->union($this->node($col, $i - 1, $j), $this->node($col, $i, $j));
                        }
                        if ($i + 1 < $row && $board[$i + 1][$j] == 'O') {
                            $uf->union($this->node($col, $i + 1, $j), $this->node($col, $i, $j));
                        }
                        if ($j > 0 && $board[$i][$j - 1] == 'O') {
                            $uf->union($this->node($col, $i, $j - 1), $this->node($col, $i, $j));
                        }
                        if ($j + 1 < $col && $board[$i][$j + 1] == 'O') {
                            $uf->union($this->node($col, $i, $j + 1), $this->node($col, $i, $j));
                        }
                    }
                }
            }
        }

        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $col; $j++) {
                if ($board[$i][$j] == 'O') {
                    if (!$uf->isConnected($this->node($col, $i, $j), $dummyNode)) {
                        $board[$i][$j] = 'X';
                    }
                }
            }
        }
    }

    function node($col, $i, $j)
    {
        return $i * $col + $j;
    }
}


/**
 * DFS O(MN) O(MN)
 * @param String[][] $board
 * @return NULL
 */
function solve(&$board)
{
    $row = count($board);
    $col = count($board[0]);
    for ($i = 0; $i < $row; $i++) {
        $this->dfs($board, $i, 0);
        $this->dfs($board, $i, $col - 1);
    }
    for ($j = 1; $j < $col - 1; $j++) {
        $this->dfs($board, 0, $j);
        $this->dfs($board, $row - 1, $j);
    }
    for ($i = 0; $i < $row; $i++) {
        for ($j = 0; $j < $col; $j++) {
            if ($board[$i][$j] == 'O') {
                $board[$i][$j] = 'X';
            }
            if ($board[$i][$j] == '#') {
                $board[$i][$j] = 'O';
            }
        }
    }
}

function dfs(&$board, $i, $j)
{
    $row = count($board);
    $col = count($board[0]);
    if ($i < 0 || $j < 0 || $i >= $row || $j >= $col || $board[$i][$j] != 'O') return;
    $board[$i][$j] = '#';
    $this->dfs($board, $i + 1, $j);
    $this->dfs($board, $i - 1, $j);
    $this->dfs($board, $i, $j + 1);
    $this->dfs($board, $i, $j - 1);
}

/**
 *
 */
$board = [
    ['O'],
];
$board = [
    ['X', 'X', 'X', 'X'],
    ['X', 'O', 'O', 'X'],
    ['X', 'X', 'O', 'X'],
    ['X', 'O', 'X', 'X'],
];
$board = [
    ["O", "X", "X", "O", "X"],
    ["X", "O", "O", "X", "O"],
    ["X", "O", "X", "O", "X"],
    ["O", "X", "O", "O", "O"],
    ["X", "X", "O", "X", "O"]
];
(new Solution())->solve2($board);
print_r($board);