<?php

class Solution
{

    /**
     * 一、双指针 O(n) O(1)
     * 不用保证相对顺序
     * @param Integer[] $nums
     * @param Integer $val
     * @return Integer
     */
    function removeElement1(&$nums, $val)
    {
        $count = count($nums);
        $j = $count - 1;
        $i = 0;
        while ($i < $count) {
            if ($nums[$i] == $val) {
                $nums[$i] = $nums[$j--];
                $count--;
            } else {
                $i++;
            }
        }
        return $count;
    }

    /**
     * 二、双指针 O(n) O(1)
     * 保证相对顺序
     * @param Integer[] $nums
     * @param Integer $val
     * @return Integer
     */
    function removeElement(&$nums, $val)
    {
        $count = count($nums);
        $j = 0;
        for ($i = $j; $i < $count; $i++) {
            if ($nums[$i] != $val) {
                $nums[$j++] = $nums[$i];
            }
        }
        return $j;
    }
}

$in = [1];
$k = 1;
$in = [4, 5];
$k = 5;
$in = [0, 1, 2, 2, 3, 0, 4, 2];
$k = 2;
$s = new Solution();
$ret = $s->removeElement($in, $k);
print_r($in);