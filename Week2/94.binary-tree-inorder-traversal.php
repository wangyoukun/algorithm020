<?php

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

    public $ret = [];

    /**
     * 一、递归 深度优先搜索 O(n) O(n)
     * @param TreeNode $root
     * @return Integer[]
     */
    function inorderTraversal($root)
    {
        $this->dfs($root);
        return $this->ret;
    }

    function dfs($root)
    {
        if (!$root) return;
        $this->dfs($root->left);
        $this->ret[] = $root->val;
        $this->dfs($root->right);
    }

    /**
     * 二、栈 栈模拟递归 O(n) O(n)
     * @param TreeNode $root
     * @return Integer[]
     */
    function inorderTraversal2($root)
    {
        $stack = new SplStack();
        while ($root || !$stack->isEmpty()) {
            while ($root) {
                $stack->push($root);
                $root = $root->left;
            }
            $root = $stack->top();
            $stack->pop();
            $this->ret[] = $root->val;
            $root = $root->right;
        }
        return $this->ret;
    }

    /**
     * 三、莫里斯遍历 有空再研究吧
     */


}