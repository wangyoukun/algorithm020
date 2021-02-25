<?php

class Solution
{

    /**
     * @param String $jewels
     * @param String $stones
     * @return Integer
     */
    function numJewelsInStones($jewels, $stones)
    {
        $hash = [];
        for ($i = 0; $i < strlen($jewels); $i++) {
            $hash[$jewels[$i]] = 1;
        }

        $count = 0;
        for ($j = 0; $j < strlen($stones); $j++) {
            if(isset($hash[$stones[$j]])){
                $count++;
            }
        }
        return $count;
    }
}

/**
 * 输入: J = "aA", S = "aAAbbbb"
 * 输出: 3
 */
$jewels = 'aA';
$stones = "aAAbbbb";
$ret = (new Solution())->numJewelsInStones($jewels, $stones);
print_r($ret);