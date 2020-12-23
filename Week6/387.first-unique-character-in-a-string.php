<?php

class Solution
{

    /**
     * 一、哈希计数 O(N) O(|Z|)
     * @param String $s
     * @return Integer
     */
    function firstUniqChar($s)
    {
        $hash = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if (!isset($hash[$s[$i]])) {
                $hash[$s[$i]] = 1;
            } else {
                $hash[$s[$i]]++;
            }
        }
        for ($i = 0; $i < strlen($s); $i++) {
            if ($hash[$s[$i]] == 1) return $i;
        }
        return -1;
    }
}

/**
 * s = "leetcode"
 * 返回 0
 * s = "loveleetcode"
 * 返回 2
 */

$s = 'loveleetcode'; //2
$ret = (new Solution())->firstUniqChar($s);
print_r($ret);
