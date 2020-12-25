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
    function longestUnivaluePath($root)
    {
        $ans = 0;
        $this->dfs2($root, $ans);
        return $ans;
    }

    /**
     * @param $root
     * @param $ans
     * @return int|mixed
     */
    function dfs3($root, &$ans)
    {
        if (!$root) return 0;
        $maxLength = 0; //以root为起点的最长同值路径
        $left = $this->dfs3($root->left, $ans); // 以root.left为起点的最长同值路径
        $right = $this->dfs3($root->right, $ans); // 以root.right为起点的最长同值路径

        if ($root->left && $root->left->val == $root->val) {
            $maxLength = max($maxLength, $left + 1);
        }

        if ($root->right && $root->right->val == $root->val) {
            $maxLength = max($maxLength, $right + 1);
        }

        //不需要更新maxLength 但要更新ans
        if ($root->left && $root->left->val == $root->val && $root->right && $root->right->val == $root->val) {
            $ans = max($ans, $left + $right + 2);
        }

        $ans = max($ans, $maxLength);
        return $maxLength;
    }

    /**
     * @param $root
     * @param $ans
     * @return int|mixed
     */
    function dfs2($root, &$ans)
    {
        if (!$root) return 0;
        $left = $this->dfs2($root->left, $ans);
        $right = $this->dfs2($root->right, $ans);

        $maxLeft = $root->left && $root->left->val == $root->val ? $left + 1 : 0;
        $maxRight = $root->right && $root->right->val == $root->val ? $right + 1 : 0;
        $ans = max($ans, $maxLeft + $maxRight);
        return max($maxLeft, $maxRight);
    }

    /**
     *
     * @param $root
     * @param $ans
     * @return int|mixed
     */
    function dfs($root, &$ans)
    {
        if (!$root) return 0;
        $left = $this->dfs($root->left, $ans); // 以root.left为起点的最长同值路径
        $right = $this->dfs($root->right, $ans);  // 以root.right为起点的最长同值路径

        $curLeft = $curRight = 0;
        if ($root->left && $root->left->val == $root->val) {
            $curLeft += $left + 1;
        }
        if ($root->right && $root->right->val == $root->val) {
            $curRight += $right + 1;
        }
        print_r('l:' . $left . '|r:' . $right . '|cl:' . $curLeft . '|cr:' . $curRight . PHP_EOL);
        $ans = max($ans, $curLeft + $curRight);
        return max($curLeft, $curRight);
    }
}

/**
 *输入:
 *     5
 *    / \
 *   4   5
 *  / \   \
 * 1   1   5
 * 输出:  2
 *
 * 输入:
 *     1
 *    / \
 *   4   5
 *  / \   \
 * 4   4   5
 *
 * 输出:  2
 */

$tree = [5, 4, 5, 1, 1, null, 5]; //2
$tree = [1, 4, 5, 4, 4, null, 5]; //2
$tree = [5, 4, 5, 4, 4, 5, 3, 4, 4, null, null, null, 4, null, null, 4];
$tree = [1, 2, 3, 4, 5, 6, 7, 8, 9, null, null, null, 13, null, null, 16, null, null, 18, null, 20, 21, null, null, 24, 25];
$tree = [1, 2, 3, 4, null, null, 7, 8, 9, null, 15];
$tree = [5, 4, 5, 4, 4, 5, 3, 4, 4, null, null, null, 4, null, null, 4, null, null, 4, null, 4, 4, null, null, 4, 4]; //6
$tree = [5, 4, 5, 4, 4, 5, 3, 4, 4, null, null, null, 4, null, null, 4, null, null, 4, null, 4, 4, null, null, 4, 4]; //6
$root = new BinaryTree($tree);
$ret = (new Solution())->longestUnivaluePath($root);
//print_r($root->showTree($root));
print_r($ret);

