<?php

class Solution
{

    /**
     * 一、回溯交换法
     * O(n * n!) O(n)
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute($nums)
    {
        global $res;
        $res = [];
        $list = $nums;
        $this->backtrack(count($nums), 0, $list);
        return $res;
    }

    function backtrack($n, $level, $list)
    {
        global $res;
        if ($level == $n) {
            $res[] = $list;
        }
        for ($i = $level; $i < $n; $i++) {
//            print_r('L:' . $level . '|i:' . $i . PHP_EOL);
//            print_r($list);
            $this->swap($list, $level, $i);
            $this->backtrack($n, $level + 1, $list); //注意这个地方是 level 不是 i
            $this->swap($list, $level, $i);
        }
    }

    function swap(&$arr, $i, $j)
    {
        $temp = $arr[$j];
        $arr[$j] = $arr[$i];
        $arr[$i] = $temp;
    }

    /**
     * 二、回溯选择法 O(N*N!) O(N)
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute2($nums)
    {
        global $res;
        $res = [];
        $n = count($nums);
        $used = array_fill(0, $n, 0);
        $this->backtrack2($nums, $n, $used, 0, []);
        return $res;
    }

    function backtrack2($nums, $n, $used, $level, $path)
    {
        global $res;
        if ($n == $level) {
            $res[] = $path;
            return;
        }
        for ($i = 0; $i < $n; $i++) {
            if (!$used[$i]) {
                array_push($path, $nums[$i]);
                $used[$i] = 1;
                $this->backtrack2($nums, $n, $used, $level + 1, $path);
                $used[$i] = 0;
                array_pop($path);
            }
        }
    }
}

/**
 * 输入: [1,2,3]
 * 输出:
 * [
 * [1,2,3],
 * [1,3,2],
 * [2,1,3],
 * [2,3,1],
 * [3,1,2],
 * [3,2,1]
 * ]
 */

$nums = [1, 2, 3];
$s = new Solution();
$ret = $s->permute2($nums);
print_r($ret);