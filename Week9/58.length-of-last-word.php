<?php

class Solution
{

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLastWord($s)
    {
        $end = strlen($s) - 1;
        while ($end >= 0 && $s[$end] == ' ') $end--;
        $start = $end;
        while ($start >= 0 && $s[$start] != ' ') $start--;
        return $end - $start;
    }
}

$s = "Hello World ";
$ret = (new Solution())->lengthOfLastWord($s);
print_r($ret);