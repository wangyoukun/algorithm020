<?php
require_once 'TreeNode.php';

class BinaryTree
{
    public $val = null;
    public $left = null;
    public $right = null;
    public $maxWidth = 1;

    public function __construct($arrTree)
    {
        //$root = $this->createTree($arrTree, 0);
        $root = $this->createTree3($arrTree);
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
        //print_r('i:' . $i . '->' . ($arrTree[$i] ?? 'null') . '|L:' . $left . '->' . ($arrTree[$left] ?? 'null') . '|R:' . $right . '->' . ($arrTree[$right] ?? 'null') . PHP_EOL);
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

    function createTree2($arrTree)
    {
        $queue = new SplQueue();
        $root = new TreeNode($arrTree[0]);
        $queue->enqueue($root);
        $levelNodeNum = 2; //注意不一定是2的幂,是上一行非空节点的数量乘2
        $startIndex = 1;
        $restNodeNum = count($arrTree) - 1;
        while ($restNodeNum > 0) {
            for ($i = $startIndex; $i < $startIndex + $levelNodeNum; $i = $i + 2) {
                if ($i == count($arrTree)) {
//                    echo '1';
//                    print_r($root);
                    return $root;
                }
                $node = $queue->dequeue();
                if (!is_null($arrTree[$i])) {
                    $node->left = new TreeNode($arrTree[$i]);
                    $queue->enqueue($node->left);
                }
                if ($i + 1 == count($arrTree)) {
//                    echo '2';
//                    print_r($root);
                    return $root;
                }
                if (!is_null($arrTree[$i + 1])) {
                    $node->right = new TreeNode($arrTree[$i + 1]);
                    $queue->enqueue($node->right);
                }
            }
            $startIndex += $levelNodeNum;
            $restNodeNum -= $levelNodeNum;
            $levelNodeNum = 2 * $queue->count();
        }
//        echo '3';
//        print_r($root);
        return $root;
    }

    function createTree3($arrTree)
    {
        $queue = new SplQueue();
        $root = new TreeNode($arrTree[0]);
        $queue->enqueue($root);
        $levelNodeNum = 2; //注意不一定是2的幂,是上一行非空节点的数量乘2
        $startIndex = 1;
        while (!$queue->isEmpty()) {
            for ($i = $startIndex; $i < $startIndex + $levelNodeNum; $i = $i + 2) {
                if ($i == count($arrTree)) {
                    return $root;
                }
                $node = $queue->dequeue();
                if (!is_null($arrTree[$i])) {
                    $node->left = new TreeNode($arrTree[$i]);
                    $queue->enqueue($node->left);
                }
                if ($i + 1 == count($arrTree)) {
                    return $root;
                }
                if (!is_null($arrTree[$i + 1])) {
                    $node->right = new TreeNode($arrTree[$i + 1]);
                    $queue->enqueue($node->right);
                }
            }
            $startIndex += $levelNodeNum;
            $levelNodeNum = 2 * $queue->count();
        }
        return $root;
    }

    /**
     * 不带树枝打印 非完全二叉树 行不通
     * @param $root
     */
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
            for ($j = 0; $j < 2 ** $i; $j++) {
                if ($i == count($arrTree) - 1) {
                    //print_r('i:' . $i . '|j:' . $j . '|v:' . 2 ** $i . PHP_EOL);
                    $dp[$i][$j] = [$i, 2 * $j];
                } else {
                    $dp[$i][$j] = [$i, ($dp[$i + 1][2 * $j][1] + $dp[$i + 1][2 * $j + 1][1]) / 2]; //仅适用于完全二叉树
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

    /**
     * 带树枝打印
     * https://cloud.tencent.com/developer/ask/60848
     * @param $root
     */
    function showTree($root)
    {
        $treeHeight = $this->treeHeight($root);
        $this->printNodeInternal([$root], 1, $treeHeight);
    }

    function printNodeInternal($nodes, $level, $maxLevel)
    {
        if (empty($nodes) || $this->isAllElementNull($nodes)) return;
        $floor = $maxLevel - $level;
        $endLine = 2 ** max($floor - 1, 0);
        $firstSpaces = 2 ** $floor - 1;
        $betweenSpaces = 2 ** ($floor + 1) - 1;
        $this->printWhiteSpaces($firstSpaces);
        $newNodes = [];
        foreach ($nodes as $node) {
            if ($node) {
                $this->displayColorText($node->val);
                //echo $node->val;
                $newNodes[] = $node->left;
                $newNodes[] = $node->right;
            } else {
                $newNodes[] = null;
                $newNodes[] = null;
                $this->echoWidthTxt(' ');
            }
            $this->printWhiteSpaces($betweenSpaces);
        }
        echo PHP_EOL;
        for ($i = 1; $i <= $endLine; $i++) {
            for ($j = 0; $j < count($nodes); $j++) {
                $this->printWhiteSpaces($firstSpaces - $i);
                if (!$nodes[$j]) {
                    $this->printWhiteSpaces($endLine + $endLine + $i + 1);
                    continue;
                }

                if ($nodes[$j]->left) {
                    $this->echoWidthTxt('/');
                } else {
                    $this->printWhiteSpaces(1);
                }

                $this->printWhiteSpaces($i + $i - 1);

                if ($nodes[$j]->right) {
                    $this->echoWidthTxt('\\');
                } else {
                    $this->printWhiteSpaces(1);
                }
                $this->printWhiteSpaces($endLine + $endLine - $i);
            }
            echo PHP_EOL;
        }
        $this->printNodeInternal($newNodes, $level + 1, $maxLevel);
    }

    function printWhiteSpaces($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->echoWidthTxt(' ');
        }
    }

    function isAllElementNull($list)
    {
        foreach ($list as $obj) {
            if ($obj) return false;
        }
        return true;
    }

    function echoWidthTxt($txt, $width = 1, $echo = 1)
    {
        $width = $this->maxWidth;
        $txt = sprintf("%' " . $width . "s", $txt);
        if ($echo) {
            echo $txt;
        } else {
            return $txt;
        }
    }

    function displayColorText($txt)
    {
        $txt = $this->echoWidthTxt($txt, $this->maxWidth, 0);
        echo "\e[34m" . $txt . "\e[0m";
    }

    function treeHeight($root)
    {
        if (!$root) return 0;
        $this->maxWidth = max($this->maxWidth, strlen($root->val));
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
//$arrTree = [1, 2, 3, 4, null, null, 7, 8, 9, null, 15];
//$a = new BinaryTree($arrTree);
////print_r($a->treeHeight($a) . '|');
//$a->printTree($a);
//$a->showTree($a);
