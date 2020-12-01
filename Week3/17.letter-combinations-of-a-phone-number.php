<?php

class Solution
{

    /**
     * 一、递归解法 O(3^n * 4^m) O(len(S))
     * @param String $digits
     * @return String[]
     */
    function letterCombinations1($digits)
    {
        global $res;
        $res = [];
        if (empty($digits)) return $res;
        $hashMap = [
            '2' => 'abc',
            '3' => 'def',
            '4' => 'ghi',
            '5' => 'jkl',
            '6' => 'mno',
            '7' => 'pqrs',
            '8' => 'tuv',
            '9' => 'wxyz',
        ];
        $this->dfs($digits, $hashMap, 0, '');
        return $res;
    }

    function dfs($digits, $hashMap, $level, $s = '')
    {
        global $res;
        if ($level == strlen($digits)) {
            $res[] = $s;
            return;
        }
        $letters = $hashMap[$digits[$level]];
        for ($i = 0; $i < strlen($letters); $i++) {
            $this->dfs($digits, $hashMap, $level + 1, $s . $letters[$i]);
        }
    }

    /**
     * 二、回溯解法 O(3^n * 4^m) O(len(S))
     * @param String $digits
     * @return String[]
     */
    function letterCombinations($digits)
    {
        global $res;
        $res = [];
        if (empty($digits)) return $res;
        $hashMap = [
            '2' => 'abc',
            '3' => 'def',
            '4' => 'ghi',
            '5' => 'jkl',
            '6' => 'mno',
            '7' => 'pqrs',
            '8' => 'tuv',
            '9' => 'wxyz',
        ];
        $this->backtrack($digits, $hashMap, 0, '');
        return $res;
    }

    function backtrack($digits, $hashMap, $level, $s)
    {
        global $res;
        if ($level == strlen($digits)) {
            $res[] = $s;
            return;
        }
        $letters = $hashMap[$digits[$level]];
        for ($i = 0; $i < strlen($letters); $i++) {
            $s = $s . $letters[$i];
            $this->dfs($digits, $hashMap, $level + 1, $s);
            $s = substr($s, 0, -1);
        }
    }

    /**
     * 三、BFS广度优先搜索 O(3^n * 4^m) O(3^n * 4^m)
     * @param String $digits
     * @return String[]
     */
    function letterCombinations3($digits)
    {
        $queue = [];
        if (empty($digits)) return $queue;
        array_push($queue, '');
        $hashMap = [
            '2' => 'abc',
            '3' => 'def',
            '4' => 'ghi',
            '5' => 'jkl',
            '6' => 'mno',
            '7' => 'pqrs',
            '8' => 'tuv',
            '9' => 'wxyz',
        ];
        for ($i = 0; $i < strlen($digits); $i++) { //BFS层数
            $size = count($queue);//队列当前层节点个数
            for ($j = 0; $j < $size; $j++) { //逐个出队
                $s = array_shift($queue);
                $letters = $hashMap[$digits[$i]];
                for ($m = 0; $m < strlen($letters); $m++) {
                    array_push($queue, $s . $letters[$m]);
                }
            }
        }
        return $queue;
    }
}

/**
 * 输入："23"
 * 输出：["ad", "ae", "af", "bd", "be", "bf", "cd", "ce", "cf"].
 */
$digits = '23';
$s = new Solution();
$ret = $s->letterCombinations3($digits);
print_r($ret);