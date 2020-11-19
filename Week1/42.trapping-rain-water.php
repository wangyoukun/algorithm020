<?php

class Solution
{

    /**
     * 一、栈 O(n) O(n)
     * @param Integer[] $height
     * @return Integer
     */
    function trap2($height)
    {
        $stack = new SplStack();
        $count = count($height);
        $ret = 0;
        for ($i = 0; $i < $count; $i++) {
            while (!$stack->isEmpty() && $height[$stack->top()] <= $height[$i]) {
                $prev = $stack->pop();
                if ($stack->isEmpty()) break;
                $boundX = $i - $stack->top() - 1;
                $boundY = min($height[$i], $height[$stack->top()]) - $height[$prev];
                $ret += $boundX * $boundY;
            }
            $stack->push($i);
        }
        return $ret;
    }

    /**
     * 二、动态规划 O(n) O(n)
     * @param Integer[] $height
     * @return Integer
     */
    function trap1($height)
    {
        $dpL = [];
        $maxL = 0;
        $dpR = [];
        $maxR = 0;
        $count = count($height);
        $ret = 0;
        for ($i = 0; $i < $count; $i++) {
            if ($height[$i] > $maxL) {
                $maxL = $height[$i];
            }
            $dpL[$i] = $maxL;
        }
        for ($i = $count - 1; $i >= 0; $i--) {
            if ($height[$i] > $maxR) {
                $maxR = $height[$i];
            }
            $dpR[$i] = $maxR;
        }

        for ($i = 1; $i < $count - 1; $i++) {
            $ret += min($dpL[$i], $dpR[$i]) - $height[$i];
        }

        return $ret;
    }


    /**
     * 三、双指针 O(n) O(1)
     * @param Integer[] $height
     * @return Integer
     */
    function trap($height)
    {
        $count = count($height);
        $pL = 0;
        $pR = $count - 1;

        $ret = 0;
        while ($pL < $pR) {
            $minHeight = min($height[$pL], $height[$pR]);
            if ($minHeight == $height[$pL]) {
                while ($pL < $pR && $height[$pL] <= $minHeight) {
                    $ret += $minHeight - $height[$pL];
                    $pL++;
                }
            } else {
                while ($pL < $pR && $height[$pR] <= $minHeight) {
                    $ret += $minHeight - $height[$pR];
                    $pR--;
                }
            }
        }
        return $ret;
    }
}

$in = [0, 1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1];
$s = new Solution();
$ret = $s->trap($in);
print_r($ret);