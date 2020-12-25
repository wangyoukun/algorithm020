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
        $rootLeft = $this->createTree($arrTree, $left);
        if ($rootLeft && !is_null($rootLeft->val)) {
            $root->left = $rootLeft;
        }
        $rootRight = $this->createTree($arrTree, $right);
        if ($rootRight && !is_null($rootRight->val)) {
            $root->right = $rootRight;
        }
        return $root;
    }

    function printTree($root)
    {
        //计算树高
        $treeHeight = $this->treeHeight($root);
        //print_r('树高:' . $treeHeight . PHP_EOL);

        //层序遍历计算原坐标
        $queue = new SplQueue();
        $queue->push($root);
        $level = 0;
        $arrTree = [];
        while (!$queue->isEmpty()) {
            $size = $queue->count();
            if ($level == $treeHeight) break;
            for ($i = 0; $i < $size; $i++) {
                $node = $queue->dequeue();
                $arrTree[$level][$i] = !$node ? 'nul' : $node->val;
                if (!$node) continue; //这个地方需要使用continue 而不是判断左节点是否为空 因为左节点为kong 也要记录的
                $queue->enqueue($node->left);
                $queue->enqueue($node->right);
            }
            $level++;
        }
        //print_r($arrTree);

        //计算新坐标
        $dp = [];
        for ($i = $treeHeight - 1; $i >= 0; $i--) {
            for ($j = 0; $j < count($arrTree[$i]); $j++) {
                if ($i == count($arrTree) - 1) {
                    $dp[$i][$j] = [$i, 2 * $j];
                } else {
                    $dp[$i][$j] = [$i, ($dp[$i + 1][2 * $j][1] + $dp[$i + 1][2 * $j + 1][1]) / 2];
                }
            }
        }
        //print_r($dp);

        //初始化打印数组
        $row = $treeHeight;
        $col = 2 ** $treeHeight;
        $tmp = array_fill(0, $col, ' ');
        $arrPrint = array_fill(0, $row, $tmp);

        //填充打印数组
        $width = 2;
        for ($i = 0; $i < count($arrTree); $i++) {
            for ($j = 0; $j < count($arrTree[$i]); $j++) {
                $x = $dp[$i][$j][0];
                $y = $dp[$i][$j][1];
                $arrPrint[$x][$y] = $arrTree[$i][$j];
                $width = max($width, strlen($arrTree[$i][$j]));
            }
        }
        //print_r($arrPrint);

        //执行打印
        //print_r($width);
        for ($i = 0; $i < count($arrPrint); $i++) {
            for ($j = 0; $j < count($arrPrint[$i]); $j++) {
                echo sprintf("%' " . $width . "s", $arrPrint[$i][$j]);
            }
            echo PHP_EOL;
        }
    }

    function treeHeight($root)
    {
        if (!$root) return 0;
        return max($this->treeHeight($root->left), $this->treeHeight($root->right)) + 1;
    }

}

/**
 *  1
 * / \
 *2   3
 *     1
 *   /   \
 *  2     3
 * / \   / \
 *4   5 6   7
 *              1
 *        /          \
 *      2             3
 *   /     \       /     \
 *  4      5       6     7
 * / \   /   \    / \   / \
 *8   9 10   11 12  13  14 15
 *
 *          1
 *     2          3
 *  4    5     6     7
 * 8 9 10 11 12 13 14 15
 *
 *                        1
 *             2                     3
 *      4           5           6           7
 *   8     9    10    11    12    13     14    15
 * 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31
 */

//$arrTree = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
//$arrTree = range(1, 127, 1);
//$arrTree = [1, 2, 3, 4, 5, null, 7];
//$arrTree = [3, 5, 1, 6, 2, 0, 8, null, null, 7, 4];
//$arrTree = range(1, 63, 1);
//$a = new BinaryTree($arrTree);
////print_r($a->treeHeight($a) . '|');
//$a->printTree($a);
