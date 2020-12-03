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
     * @return integer[][]
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
                foreach ($node->children as $child) {
                    if ($child) $queue->enqueue($child);
                }
            }
            $ret[] = $list;
        }
        return $ret;
    }
}