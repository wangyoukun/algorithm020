<?php

class Solution
{

    /**
     * 对角线模拟二分搜索 O(m + n) O(1)
     * @param Integer[][] $matrix
     * @param Integer $target
     * @return Boolean
     */
    function searchMatrix($matrix, $target)
    {
        $nr = count($matrix);
        $nc = count($matrix[0]);
        $row = $nr - 1;
        $col = 0;
        while ($row >= 0 && $col < $nc) {
            if ($matrix[$row][$col] == $target) {
                return true;
            } elseif ($matrix[$row][$col] > $target) {
                $row--;
            } else {
                $col++;
            }
        }
        return false;
    }
}

/**
 * 输入：matrix = [[1,4,7,11,15],[2,5,8,12,19],[3,6,9,16,22],[10,13,14,17,24],[18,21,23,26,30]], target = 5
 * 输出：true
 *
 * 输入：matrix = [[1,4,7,11,15],[2,5,8,12,19],[3,6,9,16,22],[10,13,14,17,24],[18,21,23,26,30]], target = 20
 * 输出：false
 */

$matrix = [[1, 4, 7, 11, 15], [2, 5, 8, 12, 19], [3, 6, 9, 16, 22], [10, 13, 14, 17, 24], [18, 21, 23, 26, 30]];
$target = 20;
$ret = (new Solution())->searchMatrix($matrix, $target);
var_dump($ret);
