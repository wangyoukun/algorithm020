<?php

class Solution
{

    /**
     * 一、以排序好的串作Key O(NKlogK) O(NK)
     * 其中 N 是 strs 的长度，而 K 是 strs 中字符串的最大长度。
     * @param String[] $strs
     * @return String[][]
     */
    function groupAnagrams($strs)
    {
        $hashMap = [];
        foreach ($strs as $str) {
            $arr = str_split($str);
            sort($arr);
            $sortedStr = implode('', $arr);
            $hashMap[$sortedStr][] = $str;
        }
        return array_values($hashMap);
    }

    /**
     * 二、以字符计数的串作Key O(NK) O(NK)
     * @param String[] $strs
     * @return String[][]
     */
    function groupAnagrams2($strs)
    {
        $hashMap = [];
        foreach ($strs as $str) {
            $arr = array_fill(0, 25, 0);
            for ($i = 0; $i < strlen($str); $i++) {
                $arr[ord($str[$i]) - ord('a')]++;
            }
            $sortedStr = implode('#', $arr);
            $hashMap[$sortedStr][] = $str;
        }
        return array_values($hashMap);
    }
}

/**
 * 输入: ["eat", "tea", "tan", "ate", "nat", "bat"]
 * 输出:
 * [
 *  ["ate","eat","tea"],
 *  ["nat","tan"],
 *  ["bat"]
 * ]
 */
$strs = ["eat", "tea", "tan", "ate", "nat", "bat"];
$s = new Solution();
$ret = $s->groupAnagrams2($strs);
print_r($ret);