<?php

class Solution
{

    /**
     * 双指针 O(n) O(1) 这中解法未保证元素的相对位置 不对
     * @param Integer[] $nums
     * @return NULL
     */
    function moveZeroes2(&$nums)
    {
        $count = count($nums);
        $j = $count - 1;
        $i = 0;
        while ($i < $j) {
            if ($nums[$i] == 0) {
                while ($i < $j && $nums[$j] == 0) {
                    $j--;
                }
                $nums[$i] = $nums[$j];
                $nums[$j] = 0;
                $j--;
            }
            $i++;
        }
    }

    /**
     * 双指针 O(n) O(1)
     * @param Integer[] $nums
     * @return NULL
     */
    function moveZeroes(&$nums)
    {
        $count = count($nums);
        $si = 0;
        for ($fi = 0; $fi < $count; $fi++) {
            if ($nums[$fi] != 0) {
                $nums[$si++] = $nums[$fi];
            }
        }
        for ($i = $si; $i < $count; $i++) {
            $nums[$i] = 0;
        }
    }
}

$in = [0, 1, 0, 3, 12];
$s = new Solution();
$ret = $s->moveZeroes($in);
print_r($in);
