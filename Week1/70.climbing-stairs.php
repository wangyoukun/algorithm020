<?php
class Solution {

    /**
     * 一、动态规划 迭代 滚动数组 O(n) O(1)
     * @param Integer $n
     * @return Integer
     */
    function climbStairs1($n) {
        if($n < 3) {
            return $n;
        }
        $f1 = 1; $f2 = 2; $f3 = 0;
        for($i = 3; $i <= $n; $i++) {
            $f3 = $f2 + $f1;
            $f1 = $f2;
            $f2 = $f3;
        }
        return $f3;
    }

    /**
     * 三、斐波那锲通项公式
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n) {
        $sqrt5 = sqrt(5);
        $fibn = pow((1 + $sqrt5)/2,$n + 1) - pow((1 - $sqrt5)/2,$n + 1);
        return (int)($fibn / $sqrt5);
    }

}

$in = 5;
$s = new Solution();
$ret = $s->climbStairs($in);
print_r($ret);