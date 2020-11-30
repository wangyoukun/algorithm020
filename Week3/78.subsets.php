<?php

class Solution
{

    /**
     * 一、回溯思路一、O(N * 2^N)(一共2^n个状态，每种状态需要O(n)的时间来构造子集) O(N)(递归时栈空间的代价为O(n))
     * 单看每个元素，都有两种选择：选入子集，或不选入子集。
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets($nums)
    {
        global $res;
        $res = []; //注意全局变量生命周期,否则多用例不能通过,也可以使用类变量来实现
        $this->dfs($nums, 0, []);
        return $res;
    }

    /**
     * 二、回溯思路二、O(N * 2^N)(一共2^n个状态，每种状态需要O(n)的时间来构造子集) O(N)(递归时栈空间的代价为O(n))
     * 每次看看有几个数能选，然后选一个,
     * 每次枚举的选项变少，每次传入子递归的 index 是：当前你选的数的索引+1当前你选的数的索引+1
     * 一直递归到「没有可选的数字」，则进入不了 for 循环，因此进不了递归，整个DFS结束。
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets2($nums)
    {
        global $res;
        $res = []; //注意全局变量生命周期,否则多用例不能通过,也可以使用类变量来实现
        $this->dfs2($nums, 0, []);
        return $res;
    }

    /**
     * 三、位运算枚举迭代 (N * 2^N)(一共2^n个状态，每种状态需要O(n)的时间来构造子集) O(N)(构造子集使用的临时数组 list 的空间代价)
     * 记原序列中元素的总数为 n。原序列中的每个数字 a_i 的状态可能有两种，即「在子集中」和「不在子集中」。
     * 我们用 1 表示「在子集中」，0 表示不在子集中，那么每一个子集可以对应一个长度为 n 的 0/1 序列，第 i 位表示 a_i 是否在子集中。
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets3($nums)
    {
        $res = [];
        for ($i = 0; $i < (1 << count($nums)); $i++) {
            $list = [];
            for ($j = 0; $j < count($nums); $j++) {
                if ($i & (1 << $j)) {
                    $list[] = $nums[$j];
                }
            }
            $res[] = $list;
        }
        return $res;
    }

    /**
     * 三、逐个循环枚举 (N * 2^N)(一共2^n个状态，每种状态需要O(n)的时间来构造子集) O(N)(构造子集使用的临时数组 list 的空间代价)
     * 记原序列中元素的总数为 n。原序列中的每个数字 a_i 的状态可能有两种，即「在子集中」和「不在子集中」。
     * 我们用 1 表示「在子集中」，0 表示不在子集中，那么每一个子集可以对应一个长度为 n 的 0/1 序列，第 i 位表示 a_i 是否在子集中。
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets4($nums)
    {
        $res = [[]];
        for ($i = 0; $i < count($nums); $i++) {
            $size = count($res);
            for ($j = 0; $j < $size; $j++) { //注意这个地方的size需要再上层写好 否则死循环
                $list = $res[$j];
                $list[] = $nums[$i];
                $res[] = $list;
            }
        }
        return $res;
    }

    function dfs($nums, $level, $list)
    {
        global $res;
        if ($level == count($nums)) {
            $res[] = $list;
            return;
        }
        $this->dfs($nums, $level + 1, $list);
        array_push($list, $nums[$level]);
        $this->dfs($nums, $level + 1, $list);
        array_pop($list);
    }

    /**
     */
    function dfs2($nums, $level, $list)
    {
        global $res;
        $res[] = $list;
        for ($i = $level; $i < count($nums); $i++) {
            array_push($list, $nums[$i]);
            $this->dfs2($nums, $i + 1, $list); // level = $i + 1 而不是 $level + 1 下一层 只有剩下的数可选
            array_pop($list);
        }
    }
}

/**
 * 输入: nums = [1,2,3]
 * 输出:
 * [
 * [3],
 * [1],
 * [2],
 * [1,2,3],
 * [1,3],
 * [2,3],
 * [1,2],
 * []
 * ]
 */
$nums = [1, 2, 3];
$s = new Solution();
$ret = $s->subsets4($nums);
print_r($ret);