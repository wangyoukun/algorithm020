<?php

class Solution
{

    /**
     * 一、堆 O(NLogN) O(K)
     * 利用内置大根堆或者优先队列实现
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest1($nums, $k)
    {
        $heapSize = $count = count($nums);
        $this->buildHeap($nums, $heapSize);
        for ($i = $count - 1; $i > $count - $k; $i--) { //计算数组最后一个元素下标
            $this->swap($nums, $i, 0);
            $heapSize--;
            $this->maxHeapify($nums, 0, $heapSize);
        }
        return $nums[0];
    }

    public function buildHeap(&$arr, $heapSize)
    {
        for ($i = floor($heapSize / 2); $i >= 0; $i--) {
            $this->maxHeapify($arr, $i, $heapSize);
        }
    }

    /**
     * 堆化
     * @param $arr
     * @param $i
     * @param $heapSize
     */
    function maxHeapify(&$arr, $i, $heapSize)
    {
        $l = 2 * $i + 1;
        $r = 2 * $i + 2;
        $max = $i;
        if ($l < $heapSize && $arr[$l] > $arr[$max]) {  //注意这里的$max可不能用$i
            $max = $l;
        }
        if ($r < $heapSize && $arr[$r] > $arr[$max]) {
            $max = $r;
        }
        //max 代表最大值的下标,有3个位置,自己当前位置，自己的左孩子,自己的右孩子
        if ($i != $max) {
            $this->swap($arr, $i, $max);
            $this->maxHeapify($arr, $max, $heapSize);
        }
    }

    /**
     * 一、内置堆 O(NLogN) O(K)
     * 利用内置大根堆或者优先队列实现
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest2($nums, $k)
    {
        //$maxHeap = new SplMaxHeap();
        $maxHeap = new SplPriorityQueue();
        for ($i = 0; $i < count($nums); $i++) {
            //$maxHeap->insert($nums[$i]);
            $maxHeap->insert($nums[$i], $nums[$i]);
        }
        for ($j = 0; $j < $k - 1; $j++) {
            $maxHeap->next();
        }
        return $maxHeap->current();
    }

    /**
     * 一、内置堆 O(NLogK) O(K)
     * 利用内置小根堆实现
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest3($nums, $k)
    {
        $heap = new SplMinHeap();
        foreach ($nums as $value) {
            if ($heap->count() < $k) {
                $heap->insert($value);
            } elseif ($value > $heap->top()) {
                $heap->extract();
                $heap->insert($value);
            }
        }
        return $heap->top();
    }

    /**
     * 二、快排变形 O(N) O(LogN)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k)
    {
        $ret = $this->quickSearch($nums, 0, count($nums), $k - 1);
        return $ret;
    }

    function quickSearch(&$arr, $l, $h, $k)
    {
        $m = $this->partition($arr, $l, $h, $k);
        if ($m == $k) {
            return $arr[$m];
        } elseif ($m < $k) {
            return $this->quickSearch($arr, $m + 1, $h, $k);
        } else {
            return $this->quickSearch($arr, $l, $m - 1, $k);
        }
    }

    function partition(&$arr, $l, $h)
    {
        $pivot = $arr[$l];
        $i = $l;
        $j = $h + 1;
        while ($i < $j) {
            while ($i < $j && $arr[--$j] < $pivot) ;
            while ($i < $j && $arr[++$i] > $pivot) ;
            if ($i != $j) {
                $this->swap($arr, $i, $j);
            }
        }
        if ($l != $j) {
            $this->swap($arr, $l, $j);
        }
        return $j;
    }

    function swap(&$arr, $i, $j)
    {
        $arr[$i] += $arr[$j];
        $arr[$j] = $arr[$i] - $arr[$j];
        $arr[$i] = $arr[$i] - $arr[$j];
    }
}

/**
 * 输入: [3,2,1,5,6,4] 和 k = 2
 * 输出: 5
 * 输入: [3,2,3,1,2,4,5,5,6] 和 k = 4
 * 输出: 4
 */
$in = [2, 1];
$k = 2;
$in = [3, 2, 1, 5, 6, 4];
$k = 2;
$s = new Solution();
$ret = $s->findKthLargest1($in, $k);
//$ret = $s->partition($in, 0, 5);
print_r($ret);