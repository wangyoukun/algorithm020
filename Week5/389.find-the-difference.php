<?php

class Solution
{

    /**
     * 一、计数
     * @param String $s
     * @param String $t
     * @return String
     */
    function findTheDifference($s, $t)
    {
        $hash = array_fill(0, 25, 0);
        for ($i = 0; $i < strlen($s); $i++) {
            $hash[ord($s[$i]) - ord('a')]++;
        }
        print_r($hash);
        for ($j = 0; $j < strlen($t); $j++) {
            if (--$hash[ord($t[$j]) - ord('a')] < 0) return $t[$j];
        }
        return '';
    }

    /**
     * 二、求和
     * @param String $s
     * @param String $t
     * @return String
     */
    function findTheDifference2($s, $t)
    {
        $sum1 = 0;
        $sum2 = 0;
        for ($i = 0; $i < strlen($s); $i++) {
            $sum1 += ord($s[$i]);
        }
        for ($j = 0; $j < strlen($t); $j++) {
            $sum2 += ord($t[$j]);
        }
        return chr($sum2 - $sum1);
    }

    /**
     * 三、位运算
     * @param String $s
     * @param String $t
     * @return String
     */
    function findTheDifference3($s, $t)
    {

    }
}

/**
 * 输入：s = "abcd", t = "abcde"
 * 输出："e"
 * 解释：'e' 是那个被添加的字母。
 *
 * 输入：s = "", t = "y"
 * 输出："y"
 * 示例 3：
 *
 * 输入：s = "a", t = "aa"
 * 输出："a"
 *
 * 输入：s = "ae", t = "aea"
 * 输出："a"
 */

$s1 = 'abcd';
$t = 'beadc';
$s = new Solution();
$ret = $s->findTheDifference2($s1, $t);
print_r($ret);
