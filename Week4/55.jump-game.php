<?php

class Solution
{

    /**
     * 贪心 O(N) O(1)
     * 对于数组中的任意一个位置 y，我们如何判断它是否可以到达？根据题目的描述，
     * 只要存在一个位置 x，它本身可以到达，并且它跳跃的最大长度为 x+nums[x]，这个值大于等于 y，即x+nums[x]≥y，那么位置 y 也可以到达。
     * @param Integer[] $nums
     * @return Boolean
     */
    function canJump($nums)
    {
        $mostRight = 0;
        for ($i = 0; $i < count($nums); $i++) {
            if ($i <= $mostRight) { //注意这个条件判断
                $mostRight = max($mostRight, $i + $nums[$i]);
                if ($mostRight >= count($nums) - 1) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function canJump2($nums)
    {
        $m = 0;
        foreach ($nums as $k => $v) {
            if ($k > $m) return false;
            $m = max($m, $k + $v);
        }
        return true;
    }
}

/**
 * 输入: [2,3,1,1,4]
 * 输出: true
 * 解释: 我们可以先跳 1 步，从位置 0 到达 位置 1, 然后再从位置 1 跳 3 步到达最后一个位置。
 * 输入: [3,2,1,0,4]
 * 输出: false
 * 解释: 无论怎样，你总会到达索引为 3 的位置。但该位置的最大跳跃长度是 0 ， 所以你永远不可能到达最后一个位置。
 */
$nums = [2, 3, 1, 1, 4];
$nums = [3, 2, 1, 0, 4];
$s = new Solution();
$ret = $s->canJump($nums);
var_dump($ret);
