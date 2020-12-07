<?php
require_once '../Lib/BinaryTree.php';

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution
{

    /**
     * 一、借助队列实现层序遍历 O(N) O(N)
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder($root)
    {
        $ret = [];
        if (!$root) return $ret;
        $queue = new SplQueue();
        $queue->enqueue($root);
        while (!$queue->isEmpty()) {
            $size = $queue->count();
            $list = [];
            for ($i = 0; $i < $size; $i++) {
                $node = $queue->dequeue();
                $list[] = $node->val;
                if ($node->left) $queue->enqueue($node->left);
                if ($node->right) $queue->enqueue($node->right);
            }
            $ret[] = $list;
        }
        return $ret;
    }

    /**
     * 二、递归实现 O(N) O(N)
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder2($root)
    {
        $ret = [];
        $this->dfs($root, 0, $ret);
        return $ret;
    }

    function dfs($root, $level, &$ret)
    {
        if (!$root) return;
        $ret[$level][] = $root->val;
        $this->dfs($root->left, $level + 1, $ret);
        $this->dfs($root->right, $level + 1, $ret);
    }

}

$root = new BinaryTree([3, 9, 20, null, null, 15, 7]);
$s = new Solution();
$ret = $s->levelOrder2($root);
print_r($ret);