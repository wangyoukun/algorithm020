<?php

class Solution
{

    /**
     * O(MN3^L) O(MN) M,N为网格长宽 L为字符串长度
     * @param String[][] $board
     * @param String $word
     * @return Boolean
     */
    function exist($board, $word)
    {
        $h = count($board);
        $w = count($board[0]);
        $tmp = array_fill(0, $w, 0);
        $visited = array_fill(0, $h, $tmp);
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                $flag = $this->backTrace($board, $visited, $i, $j, $word, 0);
                if ($flag) return true;
            }
        }
        return false;
    }

    /**
     * 从board[i][j] 开始深度优先搜索 word[k]
     * @param $board
     * @param $visited
     * @param $i
     * @param $j
     * @param $word
     * @param $k
     */
    function backTrace($board, &$visited, $i, $j, $word, $k)
    {
        if ($board[$i][$j] != $word[$k]) {
            return false;
        } elseif ($k == strlen($word) - 1) {
            return true;
        }
        $visited[$i][$j] = 1; //相当于 将原坐标值 $tmp 修改 $board[$i][$j] = '.';
        $h = count($board);
        $w = count($board[0]);
        $dx = [-1, 0, 1, 0];
        $dy = [0, -1, 0, 1];
        $result = false;
        for ($di = 0; $di < 4; $di++) {
            $nx = $i + $dx[$di];
            $ny = $j + $dy[$di];
            if ($nx >= 0 && $ny >= 0 && $nx < $h && $ny < $w && !$visited[$nx][$ny]) {
                $flag = $this->backTrace($board, $visited, $nx, $ny, $word, $k + 1);
                if ($flag) { //4个方向某一个方向能找到就返回true;
                    $result = true;
                    break;
                }
            }
        }
        $visited[$i][$j] = 0; //相当于将原坐标值 $tmp 复原 $board[$i][$j] = $tmp;
        return $result;
    }

    /**
     * @param String[][] $board
     * @param String $word
     * @return Boolean
     */
    function exist2($board, $word)
    {
        //字母板长宽
        $this->rows = count($board);
        $this->cols = count($board[0]);

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                if ($this->find($board, $word, $i, $j, 0)) {
                    return true;
                }
            }
        }

        return false;
    }

    function find(&$board, $word, $i, $j, $index)
    {
        //当前位置字母不是目标字母，返回继续遍历
        if ($board[$i][$j] != $word[$index]) {
            return false;
        }

        //成功找到最后一个字母，返回
        if ($index == strlen($word) - 1) {
            return true;
        }

        //标记当前的字母
        $ori = $word[$index];
        $board[$i][$j] = ".";

        //从四个方向依次遍历
        //检查是否出界和是否搜寻过
        if ($i - 1 >= 0 && $board[$i - 1][$j] != ".") {
            if ($this->find($board, $word, $i - 1, $j, $index + 1)) return true;
        }
        if ($j - 1 >= 0 && $board[$i][$j - 1] != ".") {
            if ($this->find($board, $word, $i, $j - 1, $index + 1)) return true;
        }
        if ($i + 1 < $this->rows && $board[$i + 1][$j] != ".") {
            if ($this->find($board, $word, $i + 1, $j, $index + 1)) return true;
        }
        if ($j + 1 < $this->cols && $board[$i][$j + 1] != ".") {
            if ($this->find($board, $word, $i, $j + 1, $index + 1)) return true;
        }

        //没找到目标字母，还原当前字母
        $board[$i][$j] = $ori;
        return false;
    }
}

/**
 * board =
 * [
 *  ['A','B','C','E'],
 *  ['S','F','C','S'],
 *  ['A','D','E','E']
 * ]
 * 给定 word = "ABCCED", 返回 true
 * 给定 word = "SEE", 返回 true
 * 给定 word = "ABCB", 返回 false
 */

$board =
    [
        ['A', 'B', 'C', 'E'],
        ['S', 'F', 'C', 'S'],
        ['A', 'D', 'E', 'E']
    ];

$word = 'ABCCED';
$word = 'SEE';
$ret = (new Solution())->exist($board, $word);
var_dump($ret);
