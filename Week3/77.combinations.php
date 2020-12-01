<?php

class Solution
{

    /**
     * 一、回溯思路一、
     * 每次看看有几个数能选
     * @param Integer $n
     * @param Integer $k
     * @return Integer[][]
     */
    function combine($n, $k)
    {
        global $res;
        $res = [];
        //$arr = range(1, $n, 1);
        $this->backtrack($n, $k, 1, []);
        return $res;
    }

    function backtrack($n, $k, $level, $list)
    {
        global $res;
        if ($k == count($list)) {  //这个地方不能 == $level
            $res[] = $list;
            return true;
        }
        /**
         * 剪枝
         * 搜索起点的上界 + 接下来要选择的元素个数 - 1 = n
         * 接下来要选择的元素个数 = k - path.size()
         * 搜索起点的上界 = n - (k - path.size()) + 1
         */
        //for ($j = $level; $j <= ($n - ($k - count($list)) + 1); $j++) { //这是剪枝
        for ($j = $level; $j <= $n; $j++) {
            array_push($list, $j);
            //print_r('递归之前:' .  print_r($list,true));
            $this->backtrack($n, $k, $j + 1, $list);
            array_pop($list);
            //print_r('递归之后:' .  print_r($list,true));
        }
    }

    /**
     * 二、回溯思路二、
     * 按照每个数选与不选
     * @param Integer $n
     * @param Integer $k
     * @return Integer[][]
     */
    function combine2($n, $k)
    {
        global $res;
        $res = [];
        $this->backtrack2($n, $k, 1, []);
        return $res;
    }

    function backtrack2($n, $k, $level, $list)
    {
        global $res;
        if ($k == 0) {
            $res[] = $list;
            return;
        }

//        if ($level > $n - $k + 1) return;  //这种写法稍微难理解一点
//        $this->backtrack2($n, $k, $level + 1, $list);

        if ($level <= $n - $k) {
            $this->backtrack2($n, $k, $level + 1, $list);
        }

        array_push($list, $level);
        $this->backtrack2($n, $k - 1, $level + 1, $list);
        array_pop($list);
    }

    /**
     * 三、回溯思路一、另一种写法
     * 有几个数能选
     * @param Integer $n
     * @param Integer $k
     * @return Integer[][]
     */
    function combine3($n, $k)
    {
        global $res;
        $res = [];
        $this->backtrack3($n, $k, 1, []);
        return $res;
    }

    function backtrack3($n, $k, $level, $list)
    {
        global $res;
        if ($k == 0) {
            $res[] = $list;
            return;
        }
        for ($i = $level; $i <= $n - $k + 1; $i++) { //这个地方不剪枝也对
            array_push($list, $i);
            $this->backtrack3($n, $k - 1, $i + 1, $list);
            array_pop($list);
        }
    }

    /**
     * 还有一种位运算,暂时看不懂 有时间再研究
     * https://leetcode-cn.com/problems/combinations/solution/zu-he-by-leetcode-solution/
     */
}

/**
 *输入: n = 4, k = 2
 * 输出:
 * [
 * [2,4],
 * [3,4],
 * [2,3],
 * [1,2],
 * [1,3],
 * [1,4],
 * ]
 */

$s = new Solution();
$ret = $s->combine(4, 2);
print_r($ret);