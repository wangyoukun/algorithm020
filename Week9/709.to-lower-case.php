<?php

class Solution
{

    /**
     * @param String $str
     * @return String
     */
    function toLowerCase($str)
    {
        for ($i = 0; $i < strlen($str); $i++) {
            $str[$i] = chr((ord($str[$i]) | 32));
        }
        return $str;
    }
}

/**
 * 输入: "LOVELY"
 * 输出: "lovely"
 *
 * 大写变小写、小写变大写 : 字符 ^= 32;
 * 大写变小写、小写变小写 : 字符 |= 32;
 * 小写变大写、大写变大写 : 字符 &= -33;
 */

$str = "LOVELY";
$ret = (new Solution())->toLowerCase($str);
print_r($ret);