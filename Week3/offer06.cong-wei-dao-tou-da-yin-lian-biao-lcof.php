<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution
{

    /**
     * 一、栈 O(N) O(N)
     * @param ListNode $head
     * @return Integer[]
     */
    function reversePrint2($head)
    {
        $ret = [];
        $stack = new SplStack();
        while ($head) {
            $stack->push($head->val);
            $head = $head->next;
        }
        while (!$stack->isEmpty()) {
            $ret[] = $stack->pop();
        }
        return $ret;
    }


    /**
     * 二、利用回溯 O(N) O(N)
     * @param ListNode $head
     * @return Integer[]
     */
    function reversePrint($head)
    {
        $this->ret = [];
        $this->dfs($head);
        return $this->ret;
    }

    function dfs($head)
    {
        if (!$head) return;
        $this->dfs($head->next);
        $this->ret[] = $head->val;
    }
}