<?php

/**
 * Definition for a binary tree node.
 */
class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($value)
    {
        $this->val = $value;
    }
}

class Solution
{

    /**
     * 一、递归 O(N) O(N)
     * 时间复杂度：O(n)，其中 n 是树中的节点个数。
     * 空间复杂度：O(n)，除去返回的答案需要的 O(n) 空间之外，我们还需要使用 O(n) 的空间存储哈希映射，以及 O(h)（其中 h 是树的高度）的空间表示递归时栈空间。这里 h < n，所以总空间复杂度为 O(n)。
     * @param Integer[] $preorder
     * @param Integer[] $inorder
     * @return TreeNode
     */
    function buildTree2($preorder, $inorder)
    {
        $this->inOrderPos = array_flip($inorder);
        return $this->treeBuild($preorder, 0, count($preorder) - 1, $inorder, 0, count($inorder) - 1);
    }

    function treeBuild($preOrder, $preL, $preR, $inOrder, $inL, $inR)
    {
        //print_r('1.preL:' . $preL . '|preR:' . $preR . '|inL:' . $inL . '|inR:' . $inR . PHP_EOL);
        if ($preL > $preR || $inL > $inR) return null;
        $rootVal = $preOrder[$preL];
        //$pIndex = $inL; while ($rootVal != $inOrder[$pIndex]) $pIndex++; //这么写时间复杂度就会变O(N^2)
        //print_r('2.preL:' . $preL . '|preR:' . $preR . '|inL:' . $inL . '|inR:' . $inR . '|pIndex:' . $pIndex . '|rootVal:' . $rootVal . PHP_EOL);
        $pIndex = $this->inOrderPos[$rootVal];
        $root = new TreeNode($rootVal);
        $root->left = $this->treeBuild($preOrder, $preL + 1, $pIndex - $inL + $preL, $inOrder, $inL, $pIndex - 1);
        $root->right = $this->treeBuild($preOrder, $pIndex - $inL + $preL + 1, $preR, $inOrder, $pIndex + 1, $inR);
        return $root;
    }

    /**
     * 二、栈 O(N) O(N)
     * 这个解法还是没看懂 有空再研究
     * @param Integer[] $preorder
     * @param Integer[] $inorder
     * @return TreeNode
     */
    function buildTree($preorder, $inorder)
    {
        $pre = 0;
        $in = 0;
        $stack = new SplStack();
        $tmp = [];
        $root = new TreeNode($preorder[$pre]);
        $curRoot = $root;
        $stack->push($curRoot);
        $tmp[] = $curRoot->val;
        $pre++;
        while ($pre < count($preorder)) {
            if ($curRoot->val == $inorder[$in]) {
                print_r('[1].pre:' . $pre . '|curRoot:' . $curRoot->val . '|in:' . $in . '|stack:' . implode(',', $tmp) . PHP_EOL);
                while (!$stack->isEmpty() && $stack->top()->val == $inorder[$in]) {
                    $curRoot = $stack->top();
                    $stack->pop();
                    array_pop($tmp);
                    $in++;
                }
                print_r('[2].pre:' . $pre . '|curRoot:' . $curRoot->val . '|in:' . $in . '|stack:' . implode(',', $tmp) . PHP_EOL);
                $curRoot->right = new TreeNode($preorder[$pre]);
                $curRoot = $curRoot->right;
                $stack->push($curRoot);
                $tmp[] = $curRoot->val;
                $pre++;
            } else {
                print_r('[3].pre:' . $pre . '|curRoot:' . $curRoot->val . '|in:' . $in . '|stack:' . implode(',', $tmp) . PHP_EOL);
                $curRoot->left = new TreeNode($preorder[$pre]);
                $curRoot = $curRoot->left;
                $stack->push($curRoot);
                $tmp[] = $curRoot->val;
                $pre++;
            }
        }
        return $root;
    }

}

$pre = [2, 1];
$in = [1, 2];
$pre = [3, 9, 20, 15, 7];
$in = [9, 3, 15, 20, 7];
$s = new Solution();
$ret = $s->buildTree($pre, $in);
print_r($ret);