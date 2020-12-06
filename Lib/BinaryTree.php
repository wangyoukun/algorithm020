<?php
require_once 'TreeNode.php';

class BinaryTree
{
    public $val = null;
    public $left = null;
    public $right = null;

    public function __construct($arrTree)
    {
        $root = $this->createTree($arrTree, 0);
        $this->val = $root->val;
        $this->left = $root->left;
        $this->right = $root->right;
    }

    function createTree($arrTree, $i)
    {
        if ($i >= count($arrTree)) return null;
        $root = new TreeNode($arrTree[$i]);
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;
        $root->left = $this->createTree($arrTree, $left);
        $root->right = $this->createTree($arrTree, $right);
        return $root;
    }
}

//$arrtree = [3,5,1,6,2,0,8,null,null,7,4];
//$a = new binarytree($arrtree);
//print_r($a);
