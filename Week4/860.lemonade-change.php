<?php

class Solution
{

    /**
     * 模拟 + 贪心 O(N) O(1)
     * @param Integer[] $bills
     * @return Boolean
     */
    function lemonadeChange($bills)
    {
        $five = 0;
        $ten = 0;
        for ($i = 0; $i < count($bills); $i++) {
            if ($bills[$i] == 5) {
                $five++;
            } elseif ($bills[$i] == 10) {
                if ($five > 0) {
                    $five--;
                    $ten++;
                } else {
                    return false;
                }
            } else {
                if ($five > 0 && $ten > 0) {
                    $five--;
                    $ten--;
                } elseif ($five >= 3) {
                    $five -= 3;
                } else {
                    return false;
                }
            }
        }
        return true;
    }
}

$bills = [5, 5, 5, 10, 20];
$s = new Solution();
$ret = $s->lemonadeChange($bills);
print_r($ret);