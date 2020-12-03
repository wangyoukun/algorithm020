<?php

class Solution
{

    /**
     * 一、使用堆进行预计算 O(1)进行取值
     * @param Integer $n
     * @return Integer
     */
    function nthUglyNumber($n)
    {
        $ret = $this->preCalcUgly($n);
        return $ret[$n - 1];
    }

    function preCalcUgly($n)
    {
        $primes = [2, 3, 5];
        $heap = new SplMinHeap();
        $this->hash = [1];
        $heap->insert(1);
        for ($i = 0; $i < 1690; $i++) {
            if (!$heap->isEmpty()) {
                $v1 = $heap->top();
                $this->nums[] = $v1;
                $heap->extract();
                for ($j = 0; $j < count($primes); $j++) {
                    $v2 = $v1 * $primes[$j];
                    if (!in_array($v2, $this->hash)) {
                        $heap->insert($v2);
                        $this->hash[] = $v2;
                    }
                }
            }
        }
        return $this->nums;
    }

    /**
     * 二、使用动态规划(三指针)进行预计算 O(1)进行取值
     * @param Integer $n
     * @return Integer
     */
    function nthUglyNumber2($n)
    {
        $dp = [1];
        $p2 = $p3 = $p5 = 0;
        for ($i = 0; $i < 1690; $i++) {
            $min = min($dp[$p2] * 2, $dp[$p3] * 3, $dp[$p5] * 5);
            $dp[] = $min;
            if ($min == $dp[$p2] * 2) $p2++;
            if ($min == $dp[$p3] * 3) $p3++;
            if ($min == $dp[$p5] * 5) $p5++;
        }
        return $dp[$n - 1];
    }
}

$s = new Solution();
$ret = $s->nthUglyNumber2(5);
print_r($ret);