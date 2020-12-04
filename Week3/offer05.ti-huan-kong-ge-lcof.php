<?php

class Solution
{

    /**
     * @param String $s
     * @return String
     */
    function replaceSpace($s)
    {
        $str = '';
        for ($i = 0; $i < strlen($s); $i++) {
            $str .= $s[$i] == ' ' ? '%20' : $s[$i];
        }
        return $str;
    }
}

/**
 * 输入：s = "We are happy."
 * 输出："We%20are%20happy."
 */

$str = 'We are happy.';
$s = new Solution();
$ret = $s->replaceSpace($str);
print_r($ret);