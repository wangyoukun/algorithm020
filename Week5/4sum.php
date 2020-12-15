<?php

class Solution
{

    /**
     * O(N^3) O(LogN) O(N)
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[][]
     */
    function fourSum($nums, $target)
    {
        sort($nums);
        $res = [];
        $n = count($nums);
        for ($i = 0; $i < $n - 3; $i++) {
            if($i > 0 && $nums[$i] == $nums[$i-1]) continue; //防重复剪枝
            if ($nums[$i] + $nums[$i + 1] + $nums[$i + 2] + $nums[$i + 3] > $target) break; //最小值比target大无解 剪枝
            for ($j = $i + 1; $j < $n - 2; $j++) {
                if($j > $i + 1 && $nums[$j] == $nums[$j - 1]) continue; //防重复剪枝 注意这个地方是 $i + 1;
                if ($nums[$i] + $nums[$j] + $nums[$n - 2] + $nums[$n - 1] < $target) continue; //最大值比targe小 此层无解剪枝
                $l = $j + 1;
                $r = $n - 1;
                while ($l < $r) {
                    $sum = $nums[$i] + $nums[$j] + $nums[$l] + $nums[$r];
                    if ($sum > $target) {
                        $r--;
                    } elseif ($sum == $target) {
                        $res[] = [$nums[$i], $nums[$j], $nums[$l], $nums[$r]];
                        $l++;
                        $r--;
                        while ($l < $r && $nums[$l] == $nums[$l - 1]) $l++;
                        while ($l < $r && $nums[$r] == $nums[$r + 1]) $r--;
                    } else {
                        $l++;
                    }

                }
            }
        }
        return $res;
    }
}

$nums = [0, 0, 0, 0];
$target = 0;
$nums = [1, 0, -1, 0, -2, 2];
$target = 0;
$s = new Solution();
$ret = $s->fourSum($nums, $target);
print_r($ret);