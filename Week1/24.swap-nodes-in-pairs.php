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
        $dummyHead = new ListNode(-1);//哨兵节点
        $dummyHead->next = $head; //哨兵节点连线
        $temp = $dummyHead; //遍历指针
        while ($temp->next && $temp->next->next) {
            $si = $temp->next; //慢指针 指向第一个节点
            $fi = $temp->next->next; //快指针 指向第二个节点
            $temp->next = $fi;
            $si->next = $fi->next;
            $fi->next = $si;
            $temp = $si->next;
        }
        return $dummyHead->next;
    }

    /**
     * 一、递归 O(n) O(n)
     * @param ListNode $head
     * @return ListNode
     */
    function swapPairs2($head)
    {
        if (!$head || !$head->next) {
            return $head;
        }
        $newHead = $head->next;
        $head->next = $this->swapPairs($newHead->next);
        $newHead->next = $head;
        return $newHead;
    }

    /**
     * 三、栈 O(n) O(1)
     * @param ListNode $head
     * @return ListNode
     */
    function swapPairs($head)
    {
        if (!$head || !$head->next) {
            return $head;
        }
        $dummyHead = new ListNode(-1); //哨兵节点
        $dummyHead->next = $head; //给哨兵节点连线
        $p = $dummyHead; //慢指针 用来串节点
        $cur = $head;  //快指针 用来遍历
        $stack = new SplStack();
        while ($cur && $cur->next) {
            $stack->push($cur);
            $stack->push($cur->next);
            $cur = $cur->next->next;
            $p->next = $stack->pop();
            $p = $p->next;
            $p->next = $stack->pop();
            $p = $p->next;
        }
        $p->next = $cur ? $cur : null; //处理尾巴
        return $dummyHead->next;
    }

}