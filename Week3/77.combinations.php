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
     * 时间复杂度：O([n/k]k)  O(k)
     * 四、 非递归（字典序法）实现组合型枚举 死磕了一晚上终于懂了一丢丢
     * 因为要保证的是字典序。所以核心是必须要增加，但是又要保证只增加最少。 对于一个二进制序列 左边为高位,右边为低位 从低位往高位看 找到第一个连续的1与其左边的0交换 1右边的所有1全部移到最低位
     * https://leetcode-cn.com/problems/combinations/solution/zu-he-by-leetcode-solution/
     * @param Integer $n
     * @param Integer $k
     * @return Integer[][]
     */
    function combine4($n, $k)
    {
        $res = [];
        $list = range(1, $k, 1);
        $list[$k] = $n + 1; //为什么k的位置要存 n + 1 呢? 因为后面循环比较最后一个值的时候会用到 为什么不是n呢？序列的最后的一个最大值是n 所以哨兵也放比n大的数
        $j = 0;
        while ($j < $k) {
            $res[] = array_slice($list, 0, $k);
            $j = 0;
            // 寻找第一个 temp[j] + 1 != temp[j + 1] 的位置 t
            // 我们需要把 [0, t - 1] 区间内的每个位置重置成 [1, t] //这就是序列一开始的样子么 看下5，3序列的图 就明白了
            while ($j < $k && $list[$j] + 1 == $list[$j + 1]) {
                $list[$j] = $j + 1;  //
                $j++;
            }
            // j 是第一个 temp[j] + 1 != temp[j + 1] 的位置
            $list[$j]++;
        }

        return $res;
    }
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
$ret = $s->combine4(5, 3);
print_r($ret);