<?php

class Solution
{

    /**
     * 一、小根堆 O(NLogK) O(N)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function topKFrequent($nums, $k)
    {
        $hash = [];
        for ($i = 0; $i < count($nums); $i++) {
            $hash[$nums[$i]]++;
        }
        $pg = new SplMinHeap();
        foreach ($hash as $key => $val) {
            if ($pg->count() < $k) {
                $pg->insert([$val, $key]);
            } else {
                if (!$pg->isEmpty() && $val > $pg->top()[0]) {
                    $pg->extract();
                    $pg->insert([$val, $key]);
                }
            }
        }
        $ret = [];
        while (!$pg->isEmpty()) {
            $ret[] = $pg->current()[1];
            $pg->next();
        }
        return $ret;
    }

    /**
     * 二、计数排序(桶排序) O(N) O(N)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function topKFrequent2($nums, $k)
    {
        $hash = [];
        for ($i = 0; $i < count($nums); $i++) {
            $hash[$nums[$i]]++;
        }
        $bucket = array_fill(0, count($nums) + 1, []); //初始化桶
        foreach ($hash as $key => $val) {
            $bucket[$val][] = $key;
        }
        $ret = [];
        for ($i = count($nums); $i >= 0 && count($ret) < $k; $i--) {
            if (!empty($bucket[$i])) {
                $ret = array_merge($ret, $bucket[$i]);
            }
        }
        return $ret;
    }

    /**
     * 三、快排变形 O(N) O(N)
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function topKFrequent3($nums, $k)
    {
        $hash = [];
        for ($i = 0; $i < count($nums); $i++) {
            $hash[$nums[$i]]++;
        }
        $arr = [];
        foreach ($hash as $key => $val) {
            $arr[] = [$key, $val];
        }
        $this->quickSearch($arr, 0, count($arr) - 1, $k - 1);
        $ret = [];
        for ($i = 0; $i < $k; $i++) {
            $ret[] = $arr[$i][0];
        }
        return $ret;
    }

    function quickSearch(&$arr, $l, $h, $k)
    {
        $m = $this->partition($arr, $l, $h, $k);
        if ($m == $k) {
            return true;
        } elseif ($m > $k) {
            $this->quickSearch($arr, $l, $m - 1, $k);
        } else {
            $this->quickSearch($arr, $m + 1, $h, $k);
        }
    }

    function partition(&$arr, $l, $h)
    {
        $pivot = $arr[$l][1];
        $i = $l;
        $j = $h + 1;
        while ($i < $j) {
            while ($i < $j && $arr[--$j][1] < $pivot) ; //这个地方一定要右边的先走, 因为对于00,这种写法上面给j加1了得给机会让它回来
            while ($i < $j && $arr[++$i][1] > $pivot) ;
            if ($i != $j) {
                $this->swap($arr, $i, $j);
            }
        }
        if ($j != $l) {
            $this->swap($arr, $l, $j);
        }
        return $j;
    }

    function swap(&$arr, $i, $j)
    {
        $tmp = $arr[$j];
        $arr[$j] = $arr[$i];
        $arr[$i] = $tmp;
    }
}

/**
 * 输入: nums = [1,1,1,2,2,3], k = 2
 * 输出: [1,2]
 */
$nums = [1, 2];
$k = 2;
$nums = [-1, -1];
$k = 1;
$nums = [1, 1, 1, 2, 2, 3];
$k = 2;
$nums = [3, 0, 1, 0];
$k = 1;
$nums = [5,1,-1,-8,-7,8,-5,0,1,10,8,0,-4,3,-1,-1,4,-5,4,-3,0,2,2,2,4,-2,-4,8,-7,-7,2,-8,0,-8,10,8,-8,-2,-9,4,-7,6,6,-1,4,2,8,-3,5,-9,-3,6,-8,-5,5,10,2,-5,-1,-5,1,-3,7,0,8,-2,-3,-1,-5,4,7,-9,0,2,10,4,4,-4,-1,-1,6,-8,-9,-1,9,-9,3,5,1,6,-1,-2,4,2,4,-6,4,4,5,-5];
$k = 7;
$nums = [5,1,-1,-8,-7,8,-5,0,1,10,8,0,-4,3,-1];
$k = 1;
$s = new Solution();
$ret = $s->topKFrequent3($nums, $k);
print_r($ret);
//$arr = [
//    [5, 5],
//    [1, 4],
//    [-1, 10],
//    [-8, 6],
//    [-7, 4],
//];
//$ret = $s->quickSearch($arr, 0, 4, 3);
//print_r($arr);
//print_r($ret);
//$ret = $s->partition($arr, 0, 0);
//print_r($arr);
//print_r($ret);
