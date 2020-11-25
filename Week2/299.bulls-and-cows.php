<?php

class Solution
{

    /**
     * @param String $secret
     * @param String $guess
     * @return String
     */
    function getHint($secret, $guess)
    {
        $hashMap = array_fill(0, 10, 0);
        $len = strlen($secret);
        $x = $y = 0;
        for ($i = 0; $i < $len; $i++) {
            $a = $secret[$i];
            $b = $guess[$i];
            if ($a == $b) {
                $x++;
            } else {
                if ($hashMap[$a]++ < 0) $y++;
                if ($hashMap[$b]-- > 0) $y++;
            }
        }
        return $x . 'A' . $y . 'B';
    }
}

$in = '1807';
$k = '7810';
$in = '1123';
$k = '0111';
$s = new Solution();
$ret = $s->getHint($in, $k);
print_r($ret);
/**
 * 输入: secret = "1807", guess = "7810"
 * 输出: "1A3B"
 * 输入: secret = "1123", guess = "0111"
 * 输出: "1A1B"
 */