<?php

class MinStack
{
    /**
     * initialize your data structure here.
     */
    function __construct()
    {
        $this->stack = [];
        $this->mStack = [];
        $this->index = -1;
    }

    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x)
    {
        $this->index++;
        $this->stack[$this->index] = $x;
        $this->mStack[$this->index] = empty($this->mStack) ? $x : ($x < $this->mStack[$this->index - 1] ? $x : $this->mStack[$this->index - 1]);
    }

    /**
     * @return NULL
     */
    function pop()
    {
        unset($this->stack[$this->index]);
        unset($this->mStack[$this->index]);
        $this->index--;
    }

    /**
     * @return Integer
     */
    function top()
    {
        return $this->stack[$this->index];
    }

    /**
     * @return Integer
     */
    function getMin()
    {
        return $this->mStack[$this->index];
    }
}

/**
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($x);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->getMin();
 */

$minStack = new MinStack();
//$minStack->push(-2);
//$minStack->push(0);
//$minStack->push(-3);
//echo $minStack->getMin() . PHP_EOL;   //--> 返回 -3.
//$minStack->pop();
//echo $minStack->top() . PHP_EOL;      //--> 返回 0.
//echo $minStack->getMin() . PHP_EOL;   //--> 返回 -2.

$minStack->push(2147483646);
$minStack->push(2147483646);
$minStack->push(2147483647);
echo '1:'. $minStack->top() . PHP_EOL;      //--> 返回 .
$minStack->pop();
echo '2:'. $minStack->getMin() . PHP_EOL;   //--> 返回 .
$minStack->pop();
echo '3:'. $minStack->getMin() . PHP_EOL;   //--> 返回 .
$minStack->pop();
$minStack->push(2147483647);
echo '4:'. $minStack->top() . PHP_EOL;      //--> 返回 .
echo '5:'. $minStack->getMin() . PHP_EOL;   //--> 返回 .
$minStack->push(-2147483648);
echo '6:'. $minStack->top() . PHP_EOL;      //--> 返回 .
echo '7:'. $minStack->getMin() . PHP_EOL;   //--> 返回 .
$minStack->pop();
echo '8:'. $minStack->getMin() . PHP_EOL;   //--> 返回 .
