<?php

class Solution
{

    /**
     * 一、哈希计数法 O(N) O(N)
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement($nums)
    {
        $hashMap = array_count_values($nums);
        $limit = count($nums) >> 1;
        foreach ($hashMap as $key => $val) {
            if ($val > $limit) {
                return $key;
            }
        }
    }

    /**
     * 二、排序法 O(NLogN) O(LogN)
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement2($nums)
    {
        sort($nums);
        $limit = count($nums) >> 1;
        return $nums[$limit];
    }

    /**
     * 三、摩尔投票法 O(N) O(1)
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement3($nums)
    {
        $count = 0;
        $candidate = null;
        for ($i = 0; $i < count($nums); $i++) {
            if ($count == 0) {
                $candidate = $nums[$i];
            }
            if ($candidate == $nums[$i]) {
                $count++;
            } else {
                $count--;
            }
        }
        return $candidate;
    }
}

$nums = [3, 2, 3];
$s = new Solution();
$ret = $s->majorityElement3($nums);
print_r($ret);