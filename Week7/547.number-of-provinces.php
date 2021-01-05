<?php
require_once '../Lib/UF.php';

class Solution
{
    /**
     * 并查集
     * @param Integer[][] $isConnected
     * @return Integer
     */
    function findCircleNum($isConnected)
    {
        $n = count($isConnected);
        $uf = new UF($n);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $i; $j++) {
                if ($isConnected[$i][$j] == 1) {
                    $uf->union($i, $j);
                }
            }
        }
        return $uf->count();
    }

    /**
     * DFS
     * @param Integer[][] $isConnected
     * @return Integer
     */
    function findCircleNum2($isConnected)
    {
        $n = count($isConnected);
        $visited = array_fill(0, $n, 0);
        $nums = 0;
        for ($i = 0; $i < $n; $i++) {
            if ($visited[$i] == 0) {
                $this->dfs($isConnected, $visited, $i);
                $nums++;
            }
        }
        return $nums;
    }

    /**
     * BFS
     * @param Integer[][] $isConnected
     * @return Integer
     */
    function findCircleNum3($isConnected)
    {
        $n = count($isConnected);
        $visited = array_fill(0, $n, 0);
        $nums = 0;
        $queue = new SplQueue();
        for ($i = 0; $i < $n; $i++) {
            if ($visited[$i] == 0) {
                $queue->enqueue($i);
                while(!$queue->isEmpty()) {
                    $k = $queue->dequeue();
                    $visited[$k] = 1;
                    for($j = 0 ; $j < $n;$j++) {
                        if($isConnected[$k][$j] == 1 && $visited[$j] == 0) {
                            $queue->enqueue($j);
                        }
                    }
                }
                $nums++;
            }
        }
        return $nums;
    }

    function dfs($isConnected, &$visited, $i)
    {
        $n = count($isConnected);
        for ($j = 0; $j < $n; $j++) {
            if ($isConnected[$i][$j] == 1 && $visited[$j] == 0) {
                $visited[$j] = 1;
                $this->dfs($isConnected, $visited, $j);
            }
        }
    }
}

/**
 * 输入：isConnected = [[1,1,0],[1,1,0],[0,0,1]]
 * 输出：2
 *
 * 输入：isConnected = [[1,0,0],[0,1,0],[0,0,1]]
 * 输出：3
 *
 * [[1,0,0,1],[0,1,1,0],[0,1,1,1],[1,0,1,1]]
 */

$isConnected = [[1, 1, 0], [1, 1, 0], [0, 0, 1]];
$isConnected = [[1, 0, 0, 1], [0, 1, 1, 0], [0, 1, 1, 1], [1, 0, 1, 1]]; //1
$ret = (new Solution())->findCircleNum3($isConnected);
print_r($ret);