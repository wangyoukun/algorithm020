<?php

class Solution
{

    /**
     * 一、堆 O(NLogK) O(K)
     * 本题是求前K小,因此用一个容量为K的大根堆，每次poll出最大的数，那堆中保留的就是前K小啦（注意不是小根堆！小根堆的话需要把全部的元素都入堆，那是O(NlogN)😂，就不是O(NlogK)啦～～）
     * 这个方法比快排慢，但是因为 Java 中提供了现成的 PriorityQueue（默认小根堆），所以实现起来最简单，没几行代码～ PHP中的优先队列是大根堆
     * @param Integer[] $arr
     * @param Integer $k
     * @return Integer[]
     */
    function getLeastNumbers2($arr, $k)
    {
        //$pq = new SplPriorityQueue(); //继承的是大根堆
        $pq = new SplMaxHeap(); //大根堆
        $count = count($arr);
        for ($i = 0; $i < $count; $i++) {
            if ($pq->count() < $k) {
                //$pq->insert($arr[$i], $arr[$i]);
                $pq->insert($arr[$i]);
            } else {
                if (!$pq->isEmpty() && $pq->top() > $arr[$i]) {
                    $pq->extract();
                    //$pq->insert($arr[$i],$arr[$i]);
                    $pq->insert($arr[$i]);
                }
            }
        }
        $ret = [];
        while ($pq->valid()) {
            $ret[] = $pq->current();
            $pq->next();;
        }
        return $ret;
    }

    /**
     * 二、php内置排序函数sort 采用的是quikSort O(NLogN) O(LogN)
     * @param Integer[] $arr
     * @param Integer $k
     * @return Integer[]
     */
    function getLeastNumbers3($arr, $k)
    {
        sort($arr);
        $ret = [];
        for ($i = 0; $i < $k; $i++) {
            $ret[] = $arr[$i];
        }
        return $ret;
    }

    /**
     * 三、快排变形 快速搜索 O(N) O(LogN)
     * 每次调用 partition 遍历的元素数目都是上一次遍历的 1/2，因此时间复杂度是 N + N/2 + N/4 + ... + N/N = 2N, 因此时间复杂度是 O(N)
     * 两种方法的优劣性比较 与堆比较
     * 在面试中，另一个常常问的问题就是这两种方法有何优劣。看起来分治法的快速选择算法的时间、空间复杂度都优于使用堆的方法，但是要注意到快速选择算法的几点局限性：
     * 第一，算法需要修改原数组，如果原数组不能修改的话，还需要拷贝一份数组，空间复杂度就上去了。
     * 第二，算法需要保存所有的数据。如果把数据看成输入流的话，使用堆的方法是来一个处理一个，不需要保存数据，只需要保存 k 个元素的最大堆。
     *  而快速选择的方法需要先保存下来所有的数据，再运行算法。当数据量非常大的时候，甚至内存都放不下的时候，就麻烦了。所以当数据量大的时候还是用基于堆的方法比较好。
     * @param Integer[] $arr
     * @param Integer $k
     * @return Integer[]
     */
    function getLeastNumbers4($arr, $k)
    {
        if ($k == 0) return [];
        if ($k >= count($arr)) return $arr;
        $this->quickSearch($arr, 0, count($arr) - 1, $k - 1);
        $ret = [];
        for ($i = 0; $i < $k; $i++) {
            $ret[] = $arr[$i];
        }
        return $ret;
    }

    /**
     * 快速搜索
     * @param $arr
     * @param $l
     * @param $h
     * @param $k
     */
    function quickSearch(&$arr, $l, $h, $k)
    {
        $m = $this->partition($arr, $l, $h);
        if ($m == $k) {
            return true;
        } elseif ($m < $k) {
            $this->quickSearch($arr, $m + 1, $h, $k);
        } else {
            $this->quickSearch($arr, $l, $m - 1, $k);
        }
    }

    /**
     * 快搜分区返回中枢索引
     * 快排分区，返回下标j，使得比nums[j]小的数都在j的左边，比nums[j]大的数都在j的右边
     * @param $arr
     * @param $l
     * @param $h
     */
    function partition(&$arr, $l, $h)
    {
        $pivot = $arr[$l]; //每次选取[第]一个元素作为基准
        $i = $l;
        $j = $h + 1;
        while ($i < $j) {
            while ($i < $j && $arr[--$j] > $pivot) ; //从右边找到一个比基准小的数
            while ($i < $j && $arr[++$i] < $pivot) ; //从左边找到一个比基准大的数
            if ($i != $j) $this->swap($arr, $i, $j);
        }
        if ($l != $j) $this->swap($arr, $l, $j); //基准归位
        return $j;
    }

    function swap(&$arr, $i, $j)
    {
        $arr[$i] += $arr[$j];
        $arr[$j] = $arr[$i] - $arr[$j];
        $arr[$i] = $arr[$i] - $arr[$j];
    }

    /**
     * 四、计数排序 O(N) O(N)
     * 数据范围有限时直接计数排序就行了
     * @param Integer[] $arr
     * @param Integer $k
     * @return Integer[]
     */
    function getLeastNumbers($arr, $k)
    {
        $hashMap = array_fill(0, 10000, 0);
        $count = count($arr);
        for ($i = 0; $i < $count; $i++) {
            $hashMap[$arr[$i]]++;
        }
        $idx = 0;
        $ret = [];
        for ($i = 0; $i < count($hashMap); $i++) {
            while ($hashMap[$i]-- > 0 && $idx < $k) {
                $ret[$idx++] = $i;
            }
            if($idx == $k) break;
        }
        return $ret;
    }
}

/*
 * 输入：arr = [3,2,1], k = 2
 * 输出：[1,2] 或者 [2,1]
 */
$in = [1, 2, 3, 4];
$k = 4;
$in = [3, 1, 2, 5, 3, 0, 4, 6];
$k = 3;
$in = [3, 2, 1];
$k = 2;
$s = new Solution();
$ret = $s->getLeastNumbers($in, $k);
//$ret = $s->partition($in, 0, 2);
//$s->quickSearch($in, 0, 2, 1);
print_r($in);
print_r($ret);
