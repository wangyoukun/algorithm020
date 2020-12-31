<?php
require_once '../Lib/Trie.php';

class Solution
{

    /**
     * O(MN * 4 * 3^(L-1)) O(N)
     * @param String[][] $board
     * @param String[] $words
     * @return String[]
     */
    function findWords($board, $words)
    {
        $trie = new Trie();
        foreach ($words as $word) {
            $trie->insert($word);
        }

        $row = count($board);
        $col = count($board[0]);

        $res = [];
        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $col; $j++) {
                $index = ord($board[$i][$j]) - ord('a');
                if (isset($trie->root->children[$index])) {
                    $this->dfs($board, $i, $j, $trie->root, $res);
                }
            }
        }
        return $res;
    }

    function dfs(&$board, $i, $j, $root, &$res)
    {
        if ($i < 0 || $j < 0 || $i >= count($board) || $j >= count($board[0])) return;
        $char = $board[$i][$j];
        if ($char == '.') return;

        $index = ord($char) - ord('a');
        if (isset($root->children[$index])) {
            $node = $root->children[$index];
            if ($node->isEnd) {
                $res[] = $node->word;
                unset($root->children[$index]);//防止重复加入 这个快
                //$node->isEnd = false; //防止重复加入  这个特别慢
            }
        } else {
            return;
        }

        $board[$i][$j] = '.';
        $this->dfs($board, $i - 1, $j, $node, $res);
        $this->dfs($board, $i + 1, $j, $node, $res);
        $this->dfs($board, $i, $j - 1, $node, $res);
        $this->dfs($board, $i, $j + 1, $node, $res);
        $board[$i][$j] = $char;
    }
}

/**
 * 输入：board = [["o","a","a","n"],["e","t","a","e"],["i","h","k","r"],["i","f","l","v"]], words = ["oath","pea","eat","rain"]
 * 输出：["eat","oath"]
 *
 * 输入:[["a","a"]] , ["a"]
 * 输出: ["a"]
 *
 */

$board = [
    ["o", "a", "a", "n"],
    ["e", "t", "a", "e"],
    ["i", "h", "k", "r"],
    ["i", "f", "l", "v"]
];
$words = ["oath", "pea", "eat", "rain"];
$board = [["a", "a"]];
$words = ["a"];
$ret = (new Solution())->findWords($board, $words);
print_r($ret);
