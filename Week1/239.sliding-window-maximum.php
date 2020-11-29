<?php

class Solution
{
    /**
     * 一、双端单调队列 O(n) O(k)
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
}

$in = [1, 3, -1, -3, 5, 3, 6, 7];
$in = [1, -1];
$in = [];
$in = [1,3,1,2,0,5];
$k = 3;
$k = 1;
$k = 0;
$k = 3;
$s = new Solution();
$ret = $s->maxSlidingWindow($in, $k);
print_r($ret);