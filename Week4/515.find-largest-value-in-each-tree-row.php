<?php
require_once '../Lib/BinaryTree.php';

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution
{

    /**
     * 一DFS O(N) O(N)
     * @param TreeNode $root
     * @return Integer[]
     */
    function largestValues($root)
    {
        $res = [];
        $this->dfs($root, 0, $res);
        return array_map(function ($v) {
            return max($v);
        }, $res);
    }

    function dfs($root, $level, &$res)
    {
        if (!$root) return;
        $res[$level][] = $root->val;
        $this->dfs($root->left, $level + 1, $res);
        $this->dfs($root->right, $level + 1, $res);
    }

    /**
     * 二BFS O(N) O(N)
     * @param TreeNode $root
     * @return Integer[]
     */
    function largestValues2($root)
    {
        $res = [];
        $queue = new SplQueue();
        $queue->enqueue($root);
        $level = 0;
        while (!$queue->isEmpty()) {
            $size = $queue->count();
            $level++;
            for ($i = 0; $i < $size; $i++) {
                $node = $queue->dequeue();
                if (!$node) continue;
                $res[$level][] = $node->val;
                $queue->enqueue($node->left);
                $queue->enqueue($node->right);
            }
        }
        return array_map(function ($v) {
            return max($v);
        }, $res);
    }

}

/**
 *
 * 输入:
 *
 *     1
 *    / \
 *   3   2
 *  / \ / \
 * 5   3   9
 *
 * 输出: [1, 3, 9]
 */

$root = new BinaryTree([1, 3, 2, 5, 3, 9]);
$s = new Solution();
$ret = $s->largestValues2($root);
print_r($ret);
