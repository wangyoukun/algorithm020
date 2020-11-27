<?php

class Solution
{

    /**
     * 一、哈希 O(m+n) O(min(m,n))
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersect2($nums1, $nums2)
    {
        $count1 = count($nums1);
        $count2 = count($nums2);
        $ret = [];
        $hash = [];
        if ($count2 < $count1) {
            return $this->intersect($nums2, $nums1);
        }
        for ($i = 0; $i < $count1; $i++) {
            $hash[$nums1[$i]]++;
        }
        for ($j = 0; $j < $count2; $j++) {
            $v = $nums2[$j];
            if (isset($hash[$v])) {
                $ret[] = $v;
                if (--$hash[$v] == 0) {
                    unset($hash[$v]);
                }
            }
        }
        return $ret;
    }

    /**
     * 二、排序双指针 O(mlogm,nlogn) O(min(m,n))
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersect($nums1, $nums2)
    {
        sort($nums1);
        sort($nums2);
        $count1 = count($nums1);
        $count2 = count($nums2);
        $ret = [];
        $i = 0;
        $j = 0;
        $idx = 0;
        while ($i < $count1 && $j < $count2) {
            if ($nums1[$i] == $nums2[$j]) {
                $ret[$idx] = $nums2[$j];
                $idx++;
                $i++;
                $j++;
            } elseif ($nums1[$i] > $nums2[$j]) {
                $j++;
            } else {
                $i++;
            }
        }
        return $ret;
    }
}

$nums1 = [1, 2, 2, 1];
$nums2 = [2, 2];
$nums1 = [4, 5, 9];
$nums2 = [4, 4, 8, 9, 9];
$s = new Solution();
$ret = $s->intersect($nums1, $nums2);
print_r($ret);