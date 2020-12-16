<?php

class Solution
{

    /**
     * 哈希 O(m + n) O(m + n)
     * @param String $pattern
     * @param String $s
     * @return Boolean
     */
    function wordPattern($pattern, $s)
    {
        $str2ch = [];
        $ch2str = [];
        $len = strlen($pattern);
        $lenStr = strlen($s);
        $k = 0;
        for ($i = 0; $i < $len; $i++) {
            if ($k >= $lenStr) return false; //str 少于 ch 的情况
            $j = $k;
            while ($j < $lenStr && $s[$j] != ' ') $j++;
            $str = substr($s, $k, $j - $k);
            $ch = $pattern[$i];
            print_r('k:' . $k . '|j:' . $j . '|ch:' . $ch . '|str:' . $str . PHP_EOL);
            if (isset($str2ch[$str]) && $str2ch[$str] != $ch) return false;
            if (isset($ch2str[$ch]) && $ch2str[$ch] != $str) return false;
            $str2ch[$str] = $ch;
            $ch2str[$ch] = $str;
            $k = $j + 1;
        }
        //print_r($str2ch);
        //print_r($ch2str);
        return $k >= $lenStr; //str 多于 ch 的情况
    }
}

/**
 * 输入: pattern = "abba", str = "dog cat cat dog"
 * 输出: true
 * 输入:pattern = "abba", str = "dog cat cat fish"
 * 输出: false
 * 输入: pattern = "aaaa", str = "dog cat cat dog"
 * 输出: false
 * 输入: pattern = "abba", str = "dog dog dog dog"
 * 输出: false
 */

$p = 'abba';
$str = 'dog cat cat dog';
$str = 'dog cat cat fish';
$p = 'aaa';
$str = 'aa aa aa aa';
$p = 'he';
$str = 'unit';
$s = new Solution();
$ret = $s->wordPattern($p, $str);
var_dump($ret);