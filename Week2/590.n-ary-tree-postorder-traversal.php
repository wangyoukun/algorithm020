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
     * 一、栈 迭代 O(M) O(M) M为树的节点树
     * @param Node $root
     * @return integer[]
     */
    function postorder2($root)
    {
        $ret = [];
        if (!$root) return $ret;
        $stack = new SplStack();
        $stack->push($root);
        while (!$stack->isEmpty()) {
            $node = $stack->pop();
            if (!$node) continue;
            $ret[] = $node->val;
            foreach ($node->children as $child) {
                if ($child) $stack->push($child);
            }
        }
        return array_reverse($ret); //N叉树后续遍历这个地方反转
    }


    /**
     * 一、递归 O(M) O(M) M为树的节点树
     * @param Node $root
     * @return integer[]
     */
    function postorder($root)
    {
        if (!$root) return [];
        $this->dfs($root);
        return $this->ret;
    }

    function dfs($root)
    {
        if (!$root) return;
        foreach ($root->children as $child) {
            $this->dfs($child);
        }
        $this->ret[] = $root->val;
    }
}