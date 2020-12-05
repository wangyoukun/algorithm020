<?php

class Solution
{

    /**
     * 一、BFS
     * @param Integer $numCourses
     * @param Integer[][] $prerequisites
     * @return Integer[]
     */
    function findOrder($numCourses, $prerequisites)
    {
        $ret = [];
        $inDegree = array_fill(0, $numCourses, 0);
        $edges = array_fill(0, $numCourses, []); // 这个地方容易出错
        for ($i = 0; $i < count($prerequisites); $i++) {
            $v = $prerequisites[$i][0];
            $k = $prerequisites[$i][1];
            $edges[$k][] = $v;
            $inDegree[$v]++;
        }

        $queue = new SplQueue();
        for ($j = 0; $j < count($inDegree); $j++) {
            if ($inDegree[$j] == 0) {
                $queue->enqueue($j);
            }
        }

        $num = 0;
        while (!$queue->isEmpty()) {
            $u = $queue->dequeue();
            $ret[] = $u;
            $num++;
            foreach ($edges[$u] as $v) {
                if (--$inDegree[$v] == 0) {
                    $queue->enqueue($v);
                }
            }
        }
        return $num == $numCourses ? $ret : [];
    }

    /**
     * 一、DFS
     * @param Integer $numCourses
     * @param Integer[][] $prerequisites
     * @return Integer[]
     */
    function findOrder2($numCourses, $prerequisites)
    {
        $visited = array_fill(0, $numCourses, 0);
        $edges = array_fill(0, $numCourses, []); // 这个地方容易出错
        for ($i = 0; $i < count($prerequisites); $i++) {
            $v = $prerequisites[$i][0];
            $k = $prerequisites[$i][1];
            $edges[$k][] = $v;
        }

        $this->ret = [];
        $this->circle = false;
        for ($j = 0; $j < $numCourses; $j++) {
            if ($visited[$j] == 0) {  //这个地方容易忘
                $this->dfs($edges, $visited, $j);
            }
        }
        return $this->circle ? [] : array_reverse($this->ret);
    }

    function dfs($edges, &$visited, $u)
    {
        $visited[$u] = 1;
        foreach ($edges[$u] as $v) {
            if ($visited[$v] == 0) {
                $this->dfs($edges, $visited, $v);
                if ($this->circle) return;
            } elseif ($visited[$v] == 1) {
                $this->circle = true;
                return;
            }
        }
        $visited[$u] = 2;
        $this->ret[] = $u;
    }
}

/**
 *输出: [0,1,2,3] or [0,2,1,3]
 * 解释:总共有 4 门课程。要学习课程 3，你应该先完成课程 1 和课程 2。并且课程 1 和课程 2 都应该排在课程 0 之后。
 * 因此，一个正确的课程顺序是[0,1,2,3] 。另一个正确的排序是[0,2,1,3] 。
 */
$prerequistes = [[1, 0], [1, 2], [0, 1]];
$numCourses = 3;
$numCourses = 4;
$prerequistes = [[1, 0], [2, 0], [3, 1], [3, 2]];

$s = new Solution();
$ret = $s->findOrder2($numCourses, $prerequistes);
print_r($ret);
