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
     * 二、矩阵快速幂
     * https://blog.csdn.net/xuzengqiang/article/details/7645020
     * https://www.cnblogs.com/liushang0419/archive/2011/10/06/2199722.html
     */

    /**
     * 三、斐波那锲通项公式 O(LogN) O(1)
     * pow 方法将会用去O(logN)的时间
     * @param Integer $n
     * @return Integer
     */
    function climbStairs3($n) {
        $sqrt5 = sqrt(5);
        $fibn = pow((1 + $sqrt5)/2,$n + 1) - pow((1 - $sqrt5)/2,$n + 1);
        return (int)($fibn / $sqrt5);
    }

    /**
     * 四、尾递归 O(n) 若优化O(1)
     * 尾递归若优化，空间复杂度可达到o(1)，但时间复杂度是o(n)
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n)
    {
        return $this->wdg($n, 1, 2);
    }

    function wdg($n, $f1, $f2)
    {
        if ($n < 2) return $f1; //递归终止条件 要到第一个值
        return $this->wdg($n - 1, $f2, $f1 + $f2);
    }

}

$in = 5;
$s = new Solution();
$ret = $s->climbStairs($in);
print_r($ret);