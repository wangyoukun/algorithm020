<?php

class Solution
{

    /**
     * 一、以入度为切入点广度优先搜索BFS O(E + V) O(E + V)
     * @param Integer $numCourses
     * @param Integer[][] $prerequisites
     * @return Boolean
     */
    function canFinish($numCourses, $prerequisites)
    {
        //构建 入度索引表 与 邻接关系表
        $inDegree = array_fill(0, $numCourses, 0);
        $edgeMap = array_fill(0, $numCourses, []);
        for ($i = 0; $i < count($prerequisites); $i++) {
            $v = $prerequisites[$i][0]; //才能学
            $k = $prerequisites[$i][1]; //先学
            $edgeMap[$k][] = $v;
            $inDegree[$v]++;
        }

        //广度优先遍历
        $queue = new SplQueue();
        for ($j = 0; $j < count($inDegree); $j++) {
            if ($inDegree[$j] == 0) {
                $queue->enqueue($j); //所有入度为0课程入队
            }
        }
        $visited = 0; //记录已出队课程数 如果最后与numCourses相等 则说明可以完成
        while (!$queue->isEmpty()) {
            $u = $queue->dequeue();
            $visited++;
            foreach ($edgeMap[$u] as $v) {   //遍历出队的课程影响到其他入度的课程
                if (--$inDegree[$v] == 0) {
                    $queue->enqueue($v);
                }
            }
        }
        return $visited == $numCourses;
    }

    /**
     * 二、以出度为切入点深度优先搜索DFS O(E + V) O(E + V)
     * @param Integer $numCourses
     * @param Integer[][] $prerequisites
     * @return Boolean
     */
    function canFinish2($numCourses, $prerequisites)
    {
        //构建 节点状态表 与 邻接关系表
        $this->valid = true; //无环 有解
        $visited = array_fill(0, $numCourses, 0);
        $edgeMap = array_fill(0, $numCourses, []);
        for ($i = 0; $i < count($prerequisites); $i++) {
            $v = $prerequisites[$i][0]; //才能学
            $k = $prerequisites[$i][1]; //先学
            $edgeMap[$k][] = $v;
        }

        for ($j = 0; $j < $numCourses; $j++) {
            if ($visited[$j] == 0) {
                $this->dfs($edgeMap, $visited, $j);
            }
        }

        return $this->valid;
    }

    function dfs($edgeMap, &$visited, $u)
    {
        $visited[$u] = 1;
        foreach ($edgeMap[$u] as $v) {
            if ($visited[$v] == 0) {
                $this->dfs($edgeMap, $visited, $v);
                if (!$this->valid) return;
            } elseif ($visited[$v] == 1) {
                $this->valid = false; //有环 无解
                return;
            }
        }
        $visited[$u] = 2;
    }
}

$numCourses = 6;
$prerequisites = [[3, 0], [3, 1], [4, 1], [4, 2], [5, 3], [5, 4]];
$s = new Solution();
$ret = $s->canFinish2($numCourses, $prerequisites);
var_dump($ret);