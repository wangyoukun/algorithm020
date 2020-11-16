<?php

class Solution
{
    /**
     * 一、暴力循环旋转 O(n*k) O(1) 会超时
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate4(&$nums, $k)
    {
        $count = count($nums);
        for ($i = 0; $i < $k; $i++) {
            $in = $nums[$count - 1];
            for ($j = 0; $j < $count; $j++) {
                $out = $nums[$j];
                $nums[$j] = $in;
                $in = $out;
            }
        }
    }

    /**
     * 二、使用额外数组预先计算好位置,然后按顺序覆盖 O(n) O(n)
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate3(&$nums, $k)
    {
        $count = count($nums);
        $arr = [];
        for ($i = 0; $i < $count; $i++) {
            $arr[($i + $k) % $count] = $nums[$i];
        }
        for ($j = 0; $j < $count; $j++) {
            $nums[$j] = $arr[$j];
        }
    }

    /**
     * 三、环状替换 O(n) O(1)
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate(&$nums, $k)
    {
        $n = count($nums);
        $count = 0;
        for ($startIndex = 0; $count < $n; $startIndex++) {
            $curIndex = $startIndex;
            $curValue = $nums[$curIndex];
            do {
                //print_r('si:' . $startIndex . '|ci:' . $curIndex . '|c:' . $count . PHP_EOL);
                $nextIndex = ($curIndex + $k) % $n;
                $nextValue = $nums[$nextIndex];
                $nums[$nextIndex] = $curValue;
                $curIndex = $nextIndex;
                $curValue = $nextValue;
                $count++;
            } while ($startIndex != $curIndex);
        }
    }

    /**
     * 四、反转 O(n) O(1)
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate2(&$nums, $k)
    {
        $len = count($nums);
        $k = $k % $len;
        $this->reverse($nums, 0, $len - 1);
        $this->reverse($nums, 0, $k - 1);
        $this->reverse($nums, $k, $len - 1);
    }

    /**
     * 反转数组
     * @param $arr
     * @param $l
     * @param $r
     */
    function reverse(&$arr, $l, $r)
    {
        while ($l < $r) {
            $tmp = $arr[$l];
            $arr[$l] = $arr[$r];
            $arr[$r] = $tmp;
            $l++;
            $r--;
        }
    }
}

$in = [-1];
$in = [1, 2, 3, 4, 5, 6, 7];
$k = 3;
$s = new Solution();
$ret = $s->rotate($in, $k);
print_r($in);