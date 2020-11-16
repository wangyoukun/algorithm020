<?php

class Solution
{
    /**
     * 移除已排序数组中重复项
     * @param Integer[] $nums
     * @return Integer
     */
    function removeDuplicates(&$nums)
    {
        $i = 0;
        for ($j = 1; $j < count($nums); $j++) {
            if ($nums[$j] != $nums[$j - 1]) {
                $nums[$i + 1] = $nums[$j];
                $i++;
            }
        }
        return $i + 1;
    }
}

$in = [1, 1, 2];
$s = new Solution();
$out = $s->removeDuplicates($in);
print_r($out);
print_r($in);