<?php

class Solution
{

    /**
     * 动态规划 自下而上 O(N^2) O(N^2)
     * dp[i][j]:表示在字符串s[0...i]中和字符串s[0...j]中最长公共子序列的长度为dp[i][j]。
     * @param String $text1
     * @param String $text2
     * @return Integer
     */
    function longestCommonSubsequence($text1, $text2)
    {
        $n1 = strlen($text1);
        $n2 = strlen($text2);
        $tmp = array_fill(0, $n2 + 1, 0);
        $dp = array_fill(0, $n1 + 1, $tmp);
        for ($i = 1; $i <= $n1; $i++) {
            for ($j = 1; $j <= $n2; $j++) {
                if ($text1[$i - 1] == $text2[$j - 1]) {
                    $dp[$i][$j] = $dp[$i - 1][$j - 1] + 1;
                } else {
                    $dp[$i][$j] = max($dp[$i - 1][$j], $dp[$i][$j - 1]);
                }
            }
        }
        return $dp[$n1][$n2];
    }

    function longestCommonSubsequence2($text1, $text2)
    {
        $n1 = strlen($text1);
        $n2 = strlen($text2);
        return $this->dp($text1, $text2, $n1 - 1, $n2 - 1);
    }

    function dp($s1, $s2, $i, $j)
    {
        if ($i == -1 || $j == -1) return 0;
        if ($s1[$i] == $s2[$j]) {
            return 1 + $this->dp($s1, $s2, $i - 1, $j - 1);
        } else {
            return max($this->dp($s1, $s2, $i - 1, $j), $this->dp($s1, $s2, $i, $j - 1));
        }
    }
}

/**
 * 输入：text1 = "abcde", text2 = "ace"
 * 输出：3
 * 解释：最长公共子序列是 "ace"，它的长度为 3。
 *
 * 输入：text1 = "abc", text2 = "abc"
 * 输出：3
 * 解释：最长公共子序列是 "abc"，它的长度为 3。
 *
 * 输入：text1 = "abc", text2 = "def"
 * 输出：0
 * 解释：两个字符串没有公共子序列，返回 0。
 */

$text1 = 'abcde';
$text2 = 'ace';
$s = new Solution();
$ret = $s->longestCommonSubsequence2($text1, $text2);
print_r($ret);