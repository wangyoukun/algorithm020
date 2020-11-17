<?php
class Solution {
    /**
     * 一、栈 O(n) O(n);
     * @param String $s
     * @return Boolean
     */
    function isValid($s)
    {
        $stack = new SplStack();
        $count = strlen($s);
        for ($i = 0; $i < $count; $i++) {
            if ($s[$i] == '(') {
                $stack->push(')');
            } elseif ($s[$i] == '[') {
                $stack->push(']');
            } elseif ($s[$i] == '{') {
                $stack->push('}');
            } elseif ($stack->isEmpty() || $stack->pop() != $s[$i]) {
                return false;
            }
        }
        return $stack->isEmpty();
    }

    /**
     * 二、替换 时间复杂度较高
     * @param String $s
     * @return Boolean
     */
    function isValid2($s) {
        $count = strlen($s);
        for ($i = 0; $i < $count / 2; $i++) {
            $s = str_ireplace("{}", '', $s);
            $s = str_ireplace("[]", '', $s);
            $s = str_ireplace("()", '', $s);
        }
        return strlen($s) > 0 ? false : true;
    }
}

$in = "(";
$in = "]]";
$in = "]";
$in = "()[]{}";
$in = "((";
$s = new Solution();
$ret = $s->isValid($in);
var_dump($ret);