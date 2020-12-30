<?php

class Solution
{

    /**
     * o(NLogN) O(N)
     * @param Integer[] $stones
     * @return Integer
     */
    function lastStoneWeight($stones)
    {
        $heap = new SplMaxHeap();
        foreach ($stones as $stone) {
            $heap->insert($stone);
        }
        while ($heap->count() > 1) {
            $s1 = $heap->extract();
            $s2 = $heap->extract();
            if ($s1 > $s2) {
                $heap->insert($s1 - $s2);
            }
        }
        return $heap->isEmpty() ? 0 : $heap->top();
    }
}

/**
 * 输入：[2,7,4,1,8,1]
 * 输出：1
 * 解释：
 * 先选出 7 和 8，得到 1，所以数组转换为 [2,4,1,1,1]，
 * 再选出 2 和 4，得到 2，所以数组转换为 [2,1,1,1]，
 * 接着是 2 和 1，得到 1，所以数组转换为 [1,1,1]，
 * 最后选出 1 和 1，得到 0，最终数组转换为 [1]，这就是最后剩下那块石头的重量。
 */
$stones = [2, 7, 4, 1, 8, 1]; //1
$ret = (new Solution())->lastStoneWeight($stones);
print_r($ret);
