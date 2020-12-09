<?php

class Solution
{

    /**
     * 3指针法预计算
     * @param Integer $k
     * @return Integer
     */
    function getKthMagicNumber($k)
    {
        $arr = [1];
        $p3 = $p5 = $p7 = 0;
        for ($i = 1; $i < $k; $i++) {
            $arr[$i] = min($arr[$p3] * 3, $arr[$p5] * 5, $arr[$p7] * 7);
            //print_r('i|' . $i . '|p3:' . $p3 . '|p5:' . $p5 . '|p7:' . $p7 . '|arr[i]:' . $arr[$i] . PHP_EOL);
            if ($arr[$i] == $arr[$p3] * 3) $p3++;
            if ($arr[$i] == $arr[$p5] * 5) $p5++;
            if ($arr[$i] == $arr[$p7] * 7) $p7++;
        }
        //print_r($arr);
        return $arr[$k - 1];
    }
}

/**
 * 素因子只包含3、5、7
 * 前几个数按顺序应该是 1，3，5，7，9，15，21。
 * 输入: k = 5
 * 输出: 9
 */

$s = new Solution();
$k = 5;
$ret = $s->getKthMagicNumber($k);
print_r($ret);