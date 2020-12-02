<?php

class Solution
{

    /** 一、排序比较 O(NLogN) O(LogN)
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram($s, $t)
    {
        $arrS = str_split($s);
        $arrT = str_split($t);
        sort($arrS);
        sort($arrT);
        $n1 = count($arrS);
        $n2 = count($arrT);
        if ($n1 != $n2) return false;
        for ($i = 0; $i < $n1; $i++) {
            if ($arrS[$i] != $arrT[$i]) {
                return false;
            }
        }
        return true;
    }

    /** 二、哈希 O(N) O(S = 26)
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram2($s, $t)
    {
        $n1 = strlen($s);
        $n2 = strlen($t);
        if ($n1 != $n2) return false;
        $hashMap = array_fill(0, 25, 0);
        for ($i = 0; $i < $n1; $i++) {
            $hashMap[ord($s[$i]) - ord('a')]++;
        }
        for ($j = 0; $j < $n2; $j++) {
            if (--$hashMap[ord($t[$j]) - ord('a')] < 0) {
                return false;
            }
        }

        return true;
    }
}

/**
 * 输入: s = "anagram", t = "nagaram"
 * 输出: true
 */
$a = "anagram";
$b = "nagaram";
$a = "a";
$b = "b";
$s = new Solution();
$ret = $s->isAnagram2($a, $b);
var_dump($ret);