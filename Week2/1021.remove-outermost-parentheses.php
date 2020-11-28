<?php

class Solution
{
    /** 单指针计数 O(N) O(N)
     * @param String $S
     * @return String
     */
    function removeOuterParentheses($S)
    {
        $count = 0;
        $str = '';
        for ($i = 0; $i < strlen($S); $i++) {
            if ($S[$i] == '(' && $count++ > 0) {
                $str .= $S[$i];
            }
            if ($S[$i] == ')' && $count-- > 1) {
                $str .= $S[$i];
            }
        }
        return $str;
    }

    /** 栈 O(N) O(N)
     * @param String $S
     * @return String
     */
    function removeOuterParentheses2($S)
    {
        $str = '';
        $stack = new SplStack();
        for ($i = 0; $i < strlen($S); $i++) {
            if ($S[$i] == '(') {
                if ($stack->count() > 0) {
                    $str .= $S[$i];
                }
                $stack->push('(');
            }
            if ($S[$i] == ')') {
                if ($stack->count() > 1) {
                    $str .= $S[$i];
                }
                $stack->pop();
            }
        }
        return $str;
    }

}

$S = "(()())(())(()(()))";
$s = new Solution();
$ret = $s->removeOuterParentheses2($S);
print_r($ret);