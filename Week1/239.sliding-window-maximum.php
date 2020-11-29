<?php

class Solution
{
    /**
     * 一、双端单调队列 O(N) O(N)
     * 输出数组使用了O(N−k+1) 空间，双向队列使用了O(k)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function maxSlidingWindow($nums, $k)
    {
        if ($k == 0 || empty($nums)) return [];
        $count = count($nums);
        $deque = new SplQueue();
        $ret = [];

        for ($i = 0; $i < $k; $i++) {
            while (!$deque->isEmpty() && $deque->top() < $nums[$i]) {
                $deque->pop();
            }
            $deque->enqueue($nums[$i]);
        }
        $ret[] = $deque->bottom();
        for ($i = $k; $i < $count; $i++) {
            if ($nums[$i - $k] == $deque->bottom()) {
                $deque->dequeue();
            }
            while (!$deque->isEmpty() && $deque->top() < $nums[$i]) {
                $deque->pop();
            }
            $deque->enqueue($nums[$i]);
            $ret[] = $deque->bottom();
        }
        return $ret;
    }

    /**
     * 二、动态规划 O(N) O(N)
     * dp(i,j) = max(dp(i,x) = right[i],dp(x,j) = left[j])
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function maxSlidingWindow2($nums, $k)
    {
        if ($k == 0 || empty($nums)) return [];
        $count = count($nums);
        $ret = [];
        $left[0] = $nums[0];
        $right[$count - 1] = $nums[$count - 1];
        for ($i = 1; $i < $count; $i++) {
            if ($i % $k == 0) {
                $left[$i] = $nums[$i];
            } else {
                $left[$i] = max($nums[$i], $left[$i - 1]);
            }
            $j = $count - $i - 1;
            if (($j + 1) % $k == 0) {
                $right[$j] = $nums[$j];
            } else {
                $right[$j] = max($nums[$j], $right[$j + 1]);
            }
        }
        for ($i = 0; $i < $count - $k + 1; $i++) {
            $ret[] = max($right[$i], $left[$i + $k - 1]);
        }
        return $ret;
    }
}

$in = [1, 3, -1, -3, 5, 3, 6, 7];
$in = [1, -1];
$in = [];
$in = [1, 3, 1, 2, 0, 5];
$k = 3;
$k = 1;
$k = 0;
$k = 3;
$s = new Solution();
$ret = $s->maxSlidingWindow2($in, $k);
print_r($ret);