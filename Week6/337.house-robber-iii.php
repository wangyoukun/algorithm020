<?php
require_once '../Lib/BinaryTree.php';

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution
{

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function rob($root)
    {
        return max($this->dfs($root));
    }

    function dfs($root)
    {
        if (!$root) return [0, 0];
        $left = $this->dfs($root->left);
        $right = $this->dfs($root->right);
        $rob = $root->val + $left[0] + $right[0]; //抢当前根节点
        $noRob = max($left[0], $left[1]) + max($right[0], $right[1]); //不抢当前根节点
        return [$noRob, $rob];
    }
}

/**
 *     3
 *    / \
 *   2   3
 *    \   \
 *     3   1
 */
$nums = [3, 2, 3, null, 3, null, 1]; //7
/**
 *     3
 *    / \
 *   4   5
 *  / \   \
 * 1   3   1
 */
$nums = [3, 4, 5, 1, 3, null, 1]; //9
$root = new BinaryTree($nums);
$ret = (new Solution())->rob($root);
print_r($ret);