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
     * 一、递归 O(m+n) O(m+n)
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists2($l1, $l2)
    {
        if (!$l1) {
            return $l2;
        } elseif (!$l2) {
            return $l1;
        }elseif($l1->val <= $l2->val){
            $l1->next = $this->mergeTwoLists($l1->next, $l2);
            return $l1;
        }else{
            $l2->next = $this->mergeTwoLists($l2->next, $l1);
            return $l2;
        }
    }

    /**
     * 一、迭代 O(m+n) O(1)
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2)
    {
        $preHead = new ListNode(-1);
        $prev = $preHead;
        while ($l1 && $l2) {
            if ($l1->val <= $l2->val) {
                $prev->next = $l1;
                $l1 = $l1->next;
            }else{
                $prev->next = $l2;
                $l2 = $l2->next;
            }
            $prev = $prev->next;
        }
        $prev->next = $l1 ? $l1 : $l2;
        return $preHead->next;
    }
}