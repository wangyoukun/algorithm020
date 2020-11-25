<?php

class Solution
{

    /**
     * O(字符集26 * 字符串) O(字符集26)
     * @param String $s
     * @return String
     */
    function sortString($s)
    {
        $startIndex = ord('a');
        $hashMap = array_fill(0, 26, 0);
        $len = strlen($s);
        for ($i = 0; $i < $len; $i++) {
            $hashMap[ord($s[$i]) - $startIndex]++;
        }
        $ret = '';
        while (strlen($ret) < $len) {
            for ($i = 0; $i < 26; $i++) {
                if ($hashMap[$i]-- > 0) {
                    $ret .= chr($i + ord('a'));
                }
            }
            for ($j = 25; $j >= 0; $j--) {
                if ($hashMap[$j]-- > 0) {
                    $ret .= chr($j + ord('a'));
                }
            }
        }
        return $ret;
    }
}

/**
 * 输入：s = "aaaabbbbcccc"
 * 输出："abccbaabccba"
 */

$in = "aaaabbbbcccc";
$s = new Solution();
$ret = $s->sortString($in);
print_r($ret);
