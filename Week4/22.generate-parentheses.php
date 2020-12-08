<?php

class Solution
{

    /**
     * @param Integer $n
     * @return String[]
     */
    function generateParenthesis($n)
    {
        $res = [];
        $this->dfs($n, 0, 0, '', $res);
        return $res;
    }

    function dfs($n, $l, $r, $str, &$res)
    {
        if ($l == $n && $r == $n) {
            $res[] = $str;
            return;
        }
        if ($l < $n) {
            $this->dfs($n, $l + 1, $r, $str . '(', $res);
        }
        if ($r < $l) {
            $this->dfs($n, $l, $r + 1, $str . ')', $res);
        }
    }
}

/**
 * 输入：n = 3
 * 输出：[
 * "((()))",
 * "(()())",
 * "(())()",
 * "()(())",
 * "()()()"
 * ]
 */

$n = 3;
$s = new Solution();
$ret = $s->generateParenthesis($n);
print_r($ret);