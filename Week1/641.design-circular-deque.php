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
    }

    /**
     * Adds an item at the front of Deque. Return true if the operation is successful.
     * @param Integer $value
     * @return Boolean
     */
    function insertFront($value)
    {
        if (!$this->isFull()) {
            array_unshift($this->deque, $value);
            $this->count++;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Adds an item at the rear of Deque. Return true if the operation is successful.
     * @param Integer $value
     * @return Boolean
     */
    function insertLast($value)
    {
        if(!$this->isFull()) {
            array_push($this->deque,$value);
            $this->count++;
            return true;
        }else{
            return false;
        }
    }

    /**
     * Deletes an item from the front of Deque. Return true if the operation is successful.
     * @return Boolean
     */
    function deleteFront()
    {
        if (!$this->isEmpty()) {
            array_shift($this->deque);
            $this->count--;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes an item from the rear of Deque. Return true if the operation is successful.
     * @return Boolean
     */
    function deleteLast()
    {
        if (!$this->isEmpty()) {
            array_pop($this->deque);
            $this->count--;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the front item from the deque.
     * @return Integer
     */
    function getFront()
    {
        return $this->deque[0] ?? -1;
    }

    /**
     * Get the last item from the deque.
     * @return Integer
     */
    function getRear()
    {
        return $this->deque[$this->count - 1] ?? -1;
    }

    /**
     * Checks whether the circular deque is empty or not.
     * @return Boolean
     */
    function isEmpty()
    {
        return $this->count > 0 ? false : true;
    }

    /**
     * Checks whether the circular deque is full or not.
     * @return Boolean
     */
    function isFull()
    {
        return ($this->count == $this->capacity) ? true : false;
    }
}

/**
 * Your MyCircularDeque object will be instantiated and called as such:
 */
$k = 3;
$obj = new MyCircularDeque($k);
$ret_1 = $obj->insertLast(1);
$ret_2 = $obj->insertLast(2);
$ret_3 = $obj->insertFront(3);
$ret_4 = $obj->insertFront(4);
$ret_5 = $obj->getRear();
$ret_6 = $obj->isFull();
$ret_7 = $obj->deleteLast();
$ret_8 = $obj->insertFront(4);
$ret_9 = $obj->getFront();
$ret_10 = $obj->isEmpty();
var_dump($ret_1, $ret_2, $ret_3, $ret_4, $ret_5, $ret_6, $ret_7, $ret_8, $ret_9, $ret_10);
