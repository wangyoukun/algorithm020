<?php
/**
 * Definition for a Node.
 * class Node {
 *     public $val = null;
 *     public $children = null;
 *     function __construct($val = 0) {
 *         $this->val = $val;
 *         $this->children = array();
 *     }
 * }
 */

class Solution
{
    /**
     * @param Node $root
     * @return integer[]
     */
    function preorder1($root)
    {
        $stack = $list = [];
        array_push($stack, $root);
        while ($stack) {
            $node = array_pop($stack);
            array_push($list, $node->val);
            if ($node->children) {
                foreach (array_reverse($node->children) as $child) {
                    array_push($stack, $child);
                }
            }
        }
        return $list;
    }

    /**
     * 一、栈迭代 O(M) O(M)
     * @param Node $root
     * @return integer[]
     */
    function preorder2($root)
    {
        $ret = [];
        if (!$root) return $ret;
        $stack = new SplStack();
        $stack->push($root);
        while (!$stack->isEmpty()) {
            $node = $stack->pop();
            if (!$node) continue;
            $ret[] = $node->val;
            foreach (array_reverse($node->children) as $child) { //N叉树前序遍历这个地方反转
                $stack->push($child);
            }
        }
        return $ret;
    }

    /**
     * 一、递归 O(M) O(M)
     * @param Node $root
     * @return integer[]
     */
    function preorder($root)
    {
        if (!$root) return [];
        $this->dfs($root);
        return $this->ret;
    }

    function dfs($root)
    {
        if (!$root) return;
        $this->ret[] = $root->val;
        foreach ($root->children as $child) {
            $this->dfs($child);
        }
    }
}

