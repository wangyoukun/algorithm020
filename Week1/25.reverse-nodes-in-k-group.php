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
     * 4指针模拟 O(n),O(1)
     * 其中n为链表的长度。head指针会在[n/k]个结点上停留，每次停留需要进行一次O(k)的翻转操作
     * @param ListNode $head
     * @param Integer $k
     * @return ListNode
     */
    function reverseKGroup1($head, $k)
    {
        $dummyHead = new ListNode(-1);
        $dummyHead->next = $head;
        $pre = $dummyHead;
        while ($head) {
            $tail = $pre; // tail是遍历指针
            for ($i = 0; $i < $k; $i++) {
                $tail = $tail->next;
                if (!$tail) {
                    return $dummyHead->next;
                }
            }
            $nextGroupHead = $tail->next;
            $arrReverse = $this->reverseLink($head, $tail);
            $rhead = $arrReverse[0];
            $rtail = $arrReverse[1];
            //连线 将反转后链表接入原链表
            $pre->next = $rhead;
            $rtail->next = $nextGroupHead;
            $pre = $rtail;
            $head = $rtail->next;
        }
        return $dummyHead->next;
    }

    /**
     * 指定头尾双指针反转链表
     * @param $head
     * @param $tail
     */
    function reverseLink($head, $tail)
    {
        $newTail = $head;
        $si = $tail->next;
        while ($si !== $tail) { //两个对象比较时要用三个== 否则val相等时可能判断不出来 如 测试用例[4,8,4] k=3 时出错
            $fi = $head->next;
            $head->next = $si;
            $si = $head;
            $head = $fi;
        }
        return [$tail, $newTail];
    }

    /**
     * 双指针反转链表
     * @param $head
     * @param $tail
     */
    function reverseLink2($head, $tail)
    {
        $si = null;
        while ($head !== $tail) {
            $fi = $head->next;
            $head->next = $si;
            $si = $head;
            $head = $fi;
        }
        return $head;
    }

    /**
     * 栈 O(n),O(k)
     * @param ListNode $head
     * @param Integer $k
     * @return ListNode
     */
    function reverseKGroup($head, $k)
    {
        $dummyHead = new ListNode(-1);
        $si = $dummyHead;
        $stack = new SplStack();
        while (true) {
            $count = 0;
            $fi = $head;
            while ($fi && $count < $k) {
                $stack->push($fi);
                $fi = $fi->next;
                $count++;
            }
            if ($count != $k) {
                $si->next = $head;
                break;
            }
            while (!$stack->isEmpty()) {
                $si->next = $stack->pop();
                $si = $si->next;
            }
            $head = $fi;
        }
        return $dummyHead->next;
    }
}