<?php

class Solution
{

    /**
     * O(nxn!) o(n)
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permuteUnique($nums)
    {
        global $res;
        $res = [];
        sort($nums);
        $n = count($nums);
        $used = array_fill(0, $n, 0);
        $this->backtrack($nums, $n, $used, 0, []);
        return $res;
    }

    function backtrack($nums, $n, $used, $level, $path)
    {
        global $res;
        if ($level == $n) {
            $res[] = $path;
        }
        for ($i = 0; $i < $n; $i++) {
            if ($i > 0 && $nums[$i] == $nums[$i - 1] && !$used[$i - 1]) {   //注意第三个条件
                continue;
            }
            if (!$used[$i]) {
                array_push($path, $nums[$i]);
                $used[$i] = 1;
                $this->backtrack($nums, $n, $used, $level + 1, $path);
                array_pop($path);
                $used[$i] = 0;
            }
        }
    }
}

$nums = [1, 1, 2];
$s = new Solution();
$ret = $s->permuteUnique($nums);
print_r($ret);