<?php

class Solution
{

    /**
     * 排序 + 贪心 O(mlogm + nlogn) O(1)
     * @param Integer[] $g
     * @param Integer[] $s
     * @return Integer
     */
    function findContentChildren($g, $s)
    {
        sort($g);
        sort($s);
        $gi = 0;
        $si = 0;
        while ($gi < count($g) && $si < count($s)) {
            if ($s[$si] >= $g[$gi]) {
                $gi++;
            }
            $si++;
        }
        return $gi;
    }
}

$g = [1, 2];
$s = [1, 2, 3];
$c = new Solution();
$ret = $c->findContentChildren($g, $s);
print_r($ret);