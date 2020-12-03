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
     * 一、递归 O(N) O(N)
     * @param TreeNode $root
     * @return Integer[]
     */
    function postorderTraversal($root)
    {
        $this->dfs($root);
        return $this->ret;
    }

    function dfs($root)
    {
        if (!$root) return;
        $this->dfs($root->left);
        $this->dfs($root->right);
        $this->ret[] = $root->val;
    }

    /**
     * 一、栈 O(N) O(N)
     * @param TreeNode $root
     * @return Integer[]
     */
    function postorderTraversal2($root)
    {
        $ret = [];
        $stack = new SplStack();
        $stack->push($root);
        while (!$stack->isEmpty()) {
            $node = $stack->pop();
            if (!$node) continue;
            $ret[] = $node->val;
            $stack->push($node->left);
            $stack->push($node->right);
        }
        return array_reverse($ret);
    }
}