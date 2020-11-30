<?php

class Solution
{

    /**
     * 一、回溯法剪枝
     * 貌似只能用70里面的回溯思路2 思路1不适合剪枝
     * 我们要去重的是同一树层上的“使用过”，同一树枝上的都是一个组合里的元素，不用去重  =>  使用过的元素不能重复选取
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsetsWithDup($nums)
    {
        global $res;
        $res = [];
        sort($nums);
        $this->dfs($nums, 0, []);
        return $res;
    }

    function dfs($nums, $level, $list)
    {
        global $res;
        $res[] = $list;
        for ($i = $level; $i < count($nums); $i++) {
            if ($i > $level && $nums[$i] == $nums[$i - 1]) continue;
            array_push($list, $nums[$i]);
            $this->dfs($nums, $i + 1, $list);
            array_pop($list);
        }
    }

    /**
     * 二、循环枚举去重
     * https://leetcode-cn.com/problems/subsets-ii/solution/xiang-xi-tong-su-de-si-lu-fen-xi-duo-jie-fa-by-19/
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsetsWithDup2($nums)
    {
        $res = [[]];
        $start = 1; //新解位置
        sort($nums);
        for ($i = 0; $i < count($nums); $i++) {
            $size = count($res);
            $ansNew = [];
            for ($j = 0; $j < $size; $j++) {
                $ansOld = $res[$j];
                if ($i > 0 && $nums[$i] == $nums[$i - 1] && $j < $start) continue;
                //print_r('i:' . $i . '|j:' . $j . '|s:' . $start . PHP_EOL);
                $ansOld[] = $nums[$i];
                $ansNew[] = $ansOld;
            }
            $start = count($res); // 更新新解位置  记录的是上一次未加入新解前老解个数 需要增加一个临时数组帮助实现
            $res = array_merge($res, $ansNew);
        }

        return $res;
    }

    /**
     * 三、位运算枚举迭代
     * https://leetcode-cn.com/problems/subsets-ii/solution/xiang-xi-tong-su-de-si-lu-fen-xi-duo-jie-fa-by-19/
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsetsWithDup3($nums)
    {
        $res = [];
        $start = 1; //新解位置
        sort($nums);
        for ($i = 0; $i < (1 << count($nums)); $i++) {
            $list = [];
            $flag = 1;
            for ($j = 0; $j < count($nums); $j++) {
                //if ((1 & ($i >> $j))) {
                    if (($i & (1 << $j))) {
                    //if ($j > 0 && $nums[$j] == $nums[$j - 1] && (($i >> ($j - 1)) & 1) == 0) {
                        if ($j > 0 && $nums[$j] == $nums[$j - 1] && (($i & (1 << ($j - 1)))) == 0) {
                        $flag = 0;
                        continue;
                    }
                    $list[] = $nums[$j];
                }
            }
            if($flag) {
                $res[] = $list;
            }
        }

        return $res;
    }

}

/**
 * 输入: nums = [1,2,2]
 * 输出:
 *[
 * [2],
 * [1],
 * [1,2,2],
 * [2,2],
 * [1,2],
 * []
 * ]
 */
$nums = [1, 2, 2];
$s = new Solution();
$ret = $s->subsetsWithDup3($nums);
print_r($ret);