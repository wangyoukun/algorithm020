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
     * 模拟竖式加法 O(n) O(1)
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2)
    {
        $head = $tail = null;
        $carry = 0;
        while ($l1 || $l2) {
            $x = $l1 ? $l1->val : 0;
            $y = $l2 ? $l2->val : 0;
            $sum = $x + $y + $carry;
            $carry = floor($sum / 10);
            if (!$tail) {
                $head = $tail = new ListNode($sum % 10);
            } else {
                $tail->next = new ListNode($sum % 10);
                $tail = $tail->next;
            }
            if ($l1) $l1 = $l1->next;
            if ($l2) $l2 = $l2->next;
        }
        if ($carry) {
            $tail->next = new ListNode(1);
        }
        return $head;
    }
}