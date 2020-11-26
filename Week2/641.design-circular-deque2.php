<?php

class MyCircularDeque
{
    /**
     * Initialize your data structure here. Set the size of the deque to be k.
     * @param Integer $k
     */
    function __construct($k)
    {
        $this->deque = [];
        $this->count = 0;
        $this->capacity = $k;
        $this->front = 0;
        $this->rear = 0; //与循环单向队列相比多增加了一个尾部指针
    }

    /**
     * Adds an item at the front of Deque. Return true if the operation is successful.
     * @param Integer $value
     * @return Boolean
     */
    function insertFront($value)
    {
        if ($this->isFull()) {
            return false;
        }
        $this->front = ($this->front - 1 + $this->capacity) % $this->capacity;
        $this->deque[$this->front] = $value; //向前移动一个位置再插值
        $this->count++;
        return true;
    }

    /**
     * Adds an item at the rear of Deque. Return true if the operation is successful.
     * @param Integer $value
     * @return Boolean
     */
    function insertLast($value)
    {
        if ($this->isFull()) {
            return false;
        }
        $this->deque[$this->rear] = $value;
        $this->rear = ($this->rear + 1) % $this->capacity; //先插值再向后移动一个位置
        $this->count++;
        return true;
    }

    /**
     * Deletes an item from the front of Deque. Return true if the operation is successful.
     * @return Boolean
     */
    function deleteFront()
    {
        if ($this->isEmpty()) {
            return false;
        }
        $this->front = ($this->front + 1) % $this->capacity;
        $this->count--;
        return true;
    }

    /**
     * Deletes an item from the rear of Deque. Return true if the operation is successful.
     * @return Boolean
     */
    function deleteLast()
    {
        if ($this->isEmpty()) {
            return false;
        }
        $this->rear = ($this->rear - 1 + $this->capacity) % $this->capacity;
        $this->count--;
        return true;
    }

    /**
     * Get the front item from the deque.
     * @return Integer
     */
    function getFront()
    {
        if ($this->isEmpty()) return -1;
        return $this->deque[$this->front];
    }

    /**
     * Get the last item from the deque.
     * @return Integer
     */
    function getRear()
    {
        if ($this->isEmpty()) return -1;
        return $this->deque[($this->rear - 1 + $this->capacity) % $this->capacity];
    }

    /**
     * Checks whether the circular deque is empty or not.
     * @return Boolean
     */
    function isEmpty()
    {
        return $this->count == 0;
    }

    /**
     * Checks whether the circular deque is full or not.
     * @return Boolean
     */
    function isFull()
    {
        return $this->count == $this->capacity;
    }
}

/**
 * Your MyCircularDeque object will be instantiated and called as such:
 */
$k = 3;
$obj = new MyCircularDeque($k);
$ret_1 = $obj->insertLast(1);
print_r($obj);
$ret_2 = $obj->insertLast(2);
print_r($obj);
$ret_3 = $obj->insertFront(3);
print_r($obj);
$ret_4 = $obj->insertFront(4);
print_r($obj);
$ret_5 = $obj->getRear();
$ret_6 = $obj->isFull();
$ret_7 = $obj->deleteLast();
$ret_8 = $obj->insertFront(4);
$ret_9 = $obj->getFront();
$ret_10 = $obj->isEmpty();
var_dump($ret_1, $ret_2, $ret_3, $ret_4, $ret_5, $ret_6, $ret_7, $ret_8, $ret_9, $ret_10);
