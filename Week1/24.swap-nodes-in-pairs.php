<?php

/**
 * Definition for a singly-linked list.
 */
class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

class Solution
{

    /**
     * 二、迭代 O(n) O(1)
     * @param ListNode $head
     * @return ListNode
     */
    function swapPairs1($head)
    {
        $dummyHead = new ListNode(-1);
        $dummyHead->next = $head;
        $temp = $dummyHead;
        while ($temp->next && $temp->next->next) {
            $si = $temp->next;
            $fi = $temp->next->next;
            $temp->next = $fi;
            $si->next = $fi->next;
            $fi->next = $si;
            $temp = $si->next;
        }
        return $dummyHead->next;
    }

    /**
     * 二、递归 O(n) O(n)
     * @param ListNode $head
     * @return ListNode
     */
    function swapPairs($head)
    {
        if (!$head || !$head->next) {
            return $head;
        }
        $newHead = $head->next;
        $head->next = $this->swapPairs($newHead->next);
        $newHead->next = $head;
        return $newHead;
    }
}