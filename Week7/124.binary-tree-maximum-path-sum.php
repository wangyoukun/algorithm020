<?php
require_once '../Lib/BinaryTree.php';

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution
{

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function maxPathSum($root)
    {
        $res = PHP_INT_MIN;
        $this->maxGain($root, $res);
        return $res;
    }

    function maxGain($root, &$res)
    {
        if (!$root) return 0;
        $left = max($this->maxGain($root->left, $res), 0); //为什么要和0比较 因为左节点值为负数可以不选
        $right = max($this->maxGain($root->right, $res), 0);
        //print_r('root->val:' . $root->val . '|L:' . $left . '|R:' . $right . PHP_EOL);
        $res = max($res, $root->val + $left + $right);
        return $root->val + max($left, $right);
    }

    public $max = PHP_INT_MIN;

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function maxPathSum2($root)
    {
        $this->maxPathSumHelper($root);
        return $this->max;

    }

    function maxPathSumHelper($root)
    {
        if (null == $root) {
            return 0;
        }

        $rightMax = 0;
        if ($root->right) {
            $rightMax = max($this->maxPathSumHelper($root->right), 0);
        }

        $leftMax = 0;
        if ($root->left) {
            $leftMax = max($this->maxPathSumHelper($root->left), 0);
        }

        $allV = $rightMax + $leftMax + $root->val;
        echo sprintf("allV=%d max=%d root=%d, leftMax=%d, rightMax=%d\n", $allV, $this->max, $root->val, $leftMax, $rightMax);

        if ($this->max < $allV) {
            $this->max = $allV;
        }
        return max($rightMax, $leftMax) + $root->val;
    }
}


/**
 * 输入：[-10,9,20,null,null,15,7]
 *
 *    -10
 *    /  \
 *   9   20
 *     /    \
 *    15     7
 *
 * 输出：42
 */
$tree = [-10, 9, 20, null, null, 15, 7]; //42
$tree = [2, -1]; //2
$root = new BinaryTree($tree);
$root->showTree($root);
$ret = (new Solution())->maxPathSum2($root);
print_r($ret);