<?php

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
     * 借助队列实现层序遍历 O(N) O(N)
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
}