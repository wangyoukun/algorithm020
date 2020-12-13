<?php

class Solution
{

    /**
     * O(N + K) O(K)
     * @param Integer[] $commands
     * @param Integer[][] $obstacles
     * @return Integer
     */
    function robotSim($commands, $obstacles)
    {
        $dx = [0, 1, 0, -1]; //注意一开始是面向北方
        $dy = [1, 0, -1, 0];
        $x = 0;
        $y = 0;
        $di = 0;
        $hash = [];
        $ans = 0;
        foreach ($obstacles as $ob) {
//            $code = (($ob[0] + 30000) << 16) + ($ob[1] + 30000); // + 30000变正 1 << 16 = 65536
//            $hash[$code] = 1;
            $hash[$ob[0]][$ob[1]] = 1; //另一种方式
        }
        foreach ($commands as $cmd) {
            if ($cmd == -1) {
                $di = ($di + 1) % 4;
            } elseif ($cmd == -2) {
                $di = ($di + 3) % 4;
            } else {
                for ($k = 0; $k < $cmd; $k++) {
                    $nx = $x + $dx[$di];
                    $ny = $y + $dy[$di];
                    //print_r('nx:' . $nx . '|ny:' . $ny . PHP_EOL);
                    //$code = (($nx + 30000) << 16) + $ny + 30000;
                    //if (!isset($hash[$code])) { //注意坐标需要移动
                    if (!isset($hash[$nx][$ny])) { //注意坐标需要移动
                        $x = $nx;
                        $y = $ny;
                        $ans = max($ans, $x * $x + $y * $y);
                    }
                }
            }
        }
        return $ans;
    }
}

/**
 * 输入: commands = [4,-1,4,-2,4], obstacles = [[2,4]]
 * 输出: 65
 * 解释: 机器人在左转走到 (1, 8) 之前将被困在 (1, 4) 处
 */

$commands = [4, -1, 4, -2, 4];
$obstacles = [[2, 4]];
$s = new Solution();
$ret = $s->robotSim($commands, $obstacles);
print_r($ret);