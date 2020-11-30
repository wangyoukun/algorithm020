<?php

class Solution
{

    /**
     * O(N) O(1)
     * 这个方法是对方法二的优化。当数字和答案的映射是定好的，那么方法二用起来也还可以。但是如果你遇到一个变态的面试官，他跟你说他需要更自由的映射关系呢？
     * 每个映射一个判断显然是不可行的，这样写出来的代码一定是丑陋不堪且难以维护的。
     * 如果老板有这样一个需求，明天你把映射关系换掉或者删除一个映射关系吧。对于这种要求，我们只能一个个去修改判断条件的代码。
     * 但我们实际上有个更优雅的做法，那就是把映射关系放在 散列表 里面
     * @param Integer $n
     * @return String[]
     */
    function fizzBuzz($n)
    {
        $map = ['3' => 'Fizz', '5' => 'Buzz',];
        $ret = [];
        for ($i = 1; $i <= $n; $i++) {
            $str = '';
            foreach ($map as $key => $val) {
                if ($i % $key == 0) {
                    $str .= $val;
                }
            }
            if(empty($str)){
                $str = (string)$i;
            }
            $ret[] = $str;
        }
        return $ret;
    }
}

$s = new Solution();
$ret = $s->fizzBuzz(20);
print_r($ret);