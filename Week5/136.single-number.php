<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function singleNumber($nums)
    {
        $ans = 0;
        foreach ($nums as $n) {
            $ans ^= $n;
        }
        return $ans;
    }
}

$nums = [2, 2, 1];
$ret = (new Solution())->singleNumber($nums);
print_r($ret);