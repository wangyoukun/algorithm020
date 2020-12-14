<?php

class Solution
{

    /**
     * O(LogN) O(1)
     * @param Integer[][] $matrix
     * @param Integer $target
     * @return Boolean
     */
    function searchMatrix($matrix, $target)
    {
        if (empty($matrix)) return false;
        $row = count($matrix);
        $col = count($matrix[0]);
        $l = 0;
        $r = $row * $col - 1;
        while ($l <= $r) {
            $mid = $l + (($r - $l) >> 1);
            $x = floor($mid / $col); //注意这个地方不是除以2不能位运算
            $y = $mid % $col;
            $midVal = $matrix[$x][$y];  //关键在这 坐标变换 其他都是标准二分查找
            //print_r('col:' . $col . '|row:' . $row . '|L:' . $l . '|R:' . $r . '|m:' . $mid . '|x:' . $x . '|y:' . $y . '|v:' . $midVal . PHP_EOL);
            if ($midVal == $target) return true;
            if ($midVal > $target) {
                $r = $mid - 1;
            } else {
                $l = $mid + 1;
            }
        }
        return false;
    }
}

$matrix = [[1, 3, 5, 7], [10, 11, 16, 20], [23, 30, 34, 50]];
$target = 31;
$matrix = [[1], [3]];
$target = 3;
$s = new Solution();
$ret = $s->searchMatrix($matrix, $target);
var_dump($ret);
