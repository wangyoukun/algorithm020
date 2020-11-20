<?php

class Solution
{

    /**
     * 双指针 O(n^2) O(1)
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function threeSum($nums)
    {
        $ret = [];
        sort($nums);
        $count = count($nums);
        if ($count < 3) return [];
        for ($i = 0; $i < $count; $i++) {
            if ($nums[$i] > 0) return $ret;
            if ($i > 0 && $nums[$i] == $nums[$i - 1]) continue; //注意这个地方一定不要写成 $i-- 死循环
            $l = $i + 1;
            $r = $count - 1;
            while ($l < $r) {
                $sum = $nums[$i] + $nums[$l] + $nums[$r];
                if ($sum < 0) {
                    $l++;
                } elseif ($sum == 0) {
                    $ret[] = [$nums[$i], $nums[$l], $nums[$r]];
                    while ($l < $r && $nums[$l] == $nums[$l + 1]) $l++;
                    while ($l < $r && $nums[$r] == $nums[$r - 1]) $r--;
                    $l++;
                    $r--;
                } elseif ($sum > 0) {
                    $r--;
                }
            }
        }
        return $ret;
    }
}


$in = [-1, 0, 1, 2, -1, -4];
$s = new Solution();
$ret = $s->threeSum($in);
print_r($ret);

/*
[
    [-1, 0, 1],
    [-1, -1, 2]
]
*/

