<?php

class Solution
{

    /**
     * 二、单调栈 O(n) O(n)
     * @param Integer[] $heights
     * @return Integer
     */
    function largestRectangleArea($heights)
    {
        $stack = new SplStack();
        $stack->push(-1);
        $count = count($heights);
        $maxArea = 0;
        for ($i = 0; $i < $count; $i++) {
            $height = $heights[$i];
            while (!$stack->isEmpty() && $heights[$stack->top()] > $height) {
                $j = $stack->pop();
                $maxArea = max($maxArea, $heights[$j] * ($i - $stack->top() - 1));
            }
            $stack->push($i);
        }
        $r = $stack->top();
        while (!$stack->isEmpty() && $stack->top() != -1) {
            $j = $stack->pop();
            $l = $stack->top();
            $maxArea = max($maxArea, $heights[$j] * ($r - $l));
        }
        return $maxArea;
    }

    /**
     * 一、暴力枚举柱体高度 O(n^2) O(1)
     * @param Integer[] $heights
     * @return Integer
     */
    function largestRectangleArea2($heights)
    {
        $count = count($heights);
        $maxArea = 0;
        for ($i = 0; $i < $count; $i++) {
            $height = $heights[$i];
            $lp = $i - 1;
            $rp = $i + 1;
            while ($lp >= 0 && $heights[$lp] >= $heights[$i]) {
                $lp--;
            }
            while ($rp < $count && $heights[$rp] >= $heights[$i]) {
                $rp++;
            }
            $maxArea = max($maxArea, $height * ($rp - $lp - 1));
        }
        return $maxArea;
    }
}

$in = [2, 1, 5, 6, 2, 3];
$in = [2,1,5,6,2,3];
$in = [2,1,2];
$in = [0];
$s = new Solution();
$ret = $s->largestRectangleArea($in);
print_r($ret);