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
     * 空间复杂度 平均为O(LogN) 最坏的情况下为链状O(N)
     * @param TreeNode $root
     * @return Integer[]
     */
    function preorderTraversal($root)
    {
        $this->dfs($root);
        return $this->ret;
    }

    function dfs($root)
    {
        if (!$root) return;
        $this->ret[] = $root->val;
        $this->preorderTraversal($root->left);
        $this->preorderTraversal($root->right);
    }

    /**
     * 二、栈 O(N) O(N)
     * 空间复杂度 平均为O(LogN) 最坏的情况下为链状O(N)
     * @param TreeNode $root
     * @return Integer[]
     */
    function preorderTraversal2($root)
    {
        $ret = [];
        $stack = new SplStack();
        $stack->push($root);
        while (!$stack->isEmpty()) {
            $node = $stack->pop();
            if (!$node) continue;
            $ret[] = $node->val;
            $stack->push($node->right);
            $stack->push($node->left);
        }
        return $ret;
    }

}