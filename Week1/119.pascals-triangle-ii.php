<?php

class Solution
{

    /**
     * 一、公式法优化 O(k) O(1)
     * 优化 C(N,K) = C(N,K-1) * (N - K + 1) / k
     * @param Integer $rowIndex
     * @return Integer[]
     */
    function getRow2($rowIndex)
    {
        $n = $rowIndex;
        $pre = 1;
        $ret = [1];
        for ($k = 1; $k <= $n; $k++) {
            $cur = $pre * ($n - $k + 1) / $k;
            $ret[] = $cur;
            $pre = $cur;
        }
        return $ret;
    }

    /**
     * 一、公式法 O(k^2) O(1)
     * @param Integer $rowIndex
     * @return Integer[]
     */
    function getRow1($rowIndex)
    {
        $ret = [];
        for ($k = 0; $k <= $rowIndex; $k++) {
            $ret[$k] = $this->combination($rowIndex, $k);
        }
        return $ret;
    }

    function combination($c, $k)
    {
        $ret = 1;
        for ($i = 1; $i <= $k; $i++) {
            $ret *= ($c - $k + $i) / $i;
        }
        return $ret;
    }

    /**
     * 一、动态规划
     * 总的来说就是利用杨辉三角形后一行与前一行的关系。
     * 更新过程为：从倒数第二个元素开始往前更新 它等于原来这个位置的数 + 前一个位置的数, 行[i] = 行[i] + 行[i-1]
     * @param Integer $rowIndex
     * @return Integer[]
     */
    function getRow($rowIndex)
    {
        $ret = [];
        for ($i = 0; $i <= $rowIndex; $i++) {
            $ret[$i] = 1; ////行末尾为1
            for ($j = $i; $j > 1; $j--) {
                $ret[$j - 1] = $ret[$j - 2] + $ret[$j - 1];
            }
        }
        return $ret;
    }

}

$in = 4;
$s = new Solution();
$out = $s->getRow1($in);
//$out = $s->C(7, 4);
print_r($out);

/**
 * 输入: 3
 * 输出: [1,3,3,1]
 */

