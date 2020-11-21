<?php

/**
 * Definition for a singly-linked list.
 */
class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val)
    {
        $this->val = $val;
    }
}

class Solution
{
    /**
     * 一、递归 O(n) O(n)
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList2($head)
    {
        if (!$head || !$head->next) return $head;
        $revNode = $this->reverseList($head->next);
        $head->next->next = $head;
        $head->next = null;
        return $revNode;
    }

    /**
     * 二、双指针迭代 O(n) O(1)
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head)
    {
        $si = null; //这是尾巴 $fi -> $si
        $fi = $head;
        while ($fi) {
            $tmp = $fi->next;
            $fi->next = $si;
            $si = $fi;
            $fi = $tmp;
        }
        return $si;
    }

}