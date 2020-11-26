<?php

class MyCircularQueue
{
    /**
     * Initialize your data structure here. Set the size of the queue to be k.
     * @param Integer $k
     */
    function __construct($k)
    {
        $this->capacity = $k;
        $this->count = 0;
        $this->queue = [];
        $this->headIndex = 0;
    }

    /**
     * Insert an element into the circular queue. Return true if the operation is successful.
     * @param Integer $value
     * @return Boolean
     */
    function enQueue($value)
    {
        if ($this->isFull()) {
            return false;
        }
        $tailIndex = ($this->headIndex + $this->count) % $this->capacity;
        $this->count++; //这一行需要计算尾索引后再增加 考虑 count = capatity - 1 时的情况
        $this->queue[$tailIndex] = $value;
        return true;
    }

    /**
     * Delete an element from the circular queue. Return true if the operation is successful.
     * @return Boolean
     */
    function deQueue()
    {
        if ($this->isEmpty()) {
            return false;
        }
        $this->count--;
        $this->headIndex = ($this->headIndex + 1) % $this->capacity;
        return true;
    }

    /**
     * Get the front item from the queue.
     * @return Integer
     */
    function Front()
    {
        if ($this->isEmpty()) return -1;
        return $this->queue[$this->headIndex];
    }

    /**
     * Get the last item from the queue.
     * @return Integer
     */
    function Rear()
    {
        if ($this->isEmpty()) return -1;
        $tailIndex = ($this->headIndex + $this->count - 1) % $this->capacity;
        return $this->queue[$tailIndex];
    }

    /**
     * Checks whether the circular queue is empty or not.
     * @return Boolean
     */
    function isEmpty()
    {
        return $this->count == 0;
    }

    /**
     * Checks whether the circular queue is full or not.
     * @return Boolean
     */
    function isFull()
    {
        return $this->count == $this->capacity;
    }
}

/**
 * Your MyCircularQueue object will be instantiated and called as such:
 * $obj = MyCircularQueue($k);
 * $ret_1 = $obj->enQueue($value);
 * $ret_2 = $obj->deQueue();
 * $ret_3 = $obj->Front();
 * $ret_4 = $obj->Rear();
 * $ret_5 = $obj->isEmpty();
 * $ret_6 = $obj->isFull();
 */

/**
 * MyCircularQueue circularQueue = new MyCircularQueue(3); // 设置长度为 3
 * circularQueue.enQueue(1); // 返回 true
 * circularQueue.enQueue(2); // 返回 true
 * circularQueue.enQueue(3); // 返回 true
 * circularQueue.enQueue(4); // 返回 false，队列已满
 * circularQueue.Rear(); // 返回 3
 * circularQueue.isFull(); // 返回 true
 * circularQueue.deQueue(); // 返回 true
 * circularQueue.enQueue(4); // 返回 true
 * circularQueue.Rear(); // 返回 4
 */