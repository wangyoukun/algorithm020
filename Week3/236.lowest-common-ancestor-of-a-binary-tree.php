<?php
require_once '../Lib/BinaryTree.php';

class Solution
{
    /**
     * O(N) O(N)
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q)
    {
        if (!$root || $p === $root || $q === $root) return $root;
        $left = $this->lowestCommonAncestor($root->left, $p, $q);
        $right = $this->lowestCommonAncestor($root->right, $p, $q);
        if (!$left) return $right;
        if (!$right) return $left;
        return $root;
    }

    function dfs($root)
    {
        if (!$root) return;
        print_r('1 => ' . $root->val . PHP_EOL);
        $this->dfs($root->left);
        print_r('2 => ' . $root->val . PHP_EOL);
        $this->dfs($root->right);
        print_r('3 => ' . $root->val . PHP_EOL);
    }
}

/**
 * 输入: root = [3,5,1,6,2,0,8,null,null,7,4], p = 5, q = 1
 * 输出: 3
 * 解释: 节点 5 和节点 1 的最近公共祖先是节点 3。
 */

$tree = [3, 5, 1, 6, 2, 0, 8, null, null, 7, 4];
$root = new BinaryTree($tree);
//print_r($root);
$s = new Solution();
//$s->dfs($root);
$p = $root->left->right->right;
$q = $root->left->right->left;
$ret = $s->lowestCommonAncestor($root, $p, $q);
print_r($ret);
