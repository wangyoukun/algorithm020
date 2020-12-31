<?php
require_once 'TrieNode.php';

class Trie
{
    /**
     * Initialize your data structure here.
     */
    function __construct()
    {
        $this->root = new TrieNode();
    }

    /**
     * Inserts a word into the trie.
     * @param String $word
     * @return NULL
     */
    function insert($word)
    {
        $node = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            $index = ord($word[$i]) - ord('a');
            if (!isset($node->children[$index])) {
                $node->children[$index] = new TrieNode();
            }
            //每个节点都是必须要有的
            $node = $node->children[$index];
        }
        $node->isEnd = true;
        $node->word = $word;
    }

    /**
     * Returns if the word is in the trie.
     * @param String $word
     * @return Boolean
     */
    function search($word)
    {
        $node = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            $index = ord($word[$i]) - ord('a');
            if (isset($node->children[$index])) {
                $node = $node->children[$index];
            } else {
                return false;
            }
        }
        return $node->isEnd;
    }

    /**
     * Returns if there is any word in the trie that starts with the given prefix.
     * @param String $prefix
     * @return Boolean
     */
    function startsWith($prefix)
    {
        $node = $this->root;
        for ($i = 0; $i < strlen($prefix); $i++) {
            $index = ord($prefix[$i]) - ord('a');
            if (isset($node->children[$index])) {
                $node = $node->children[$index];
            } else {
                return false;
            }
        }
        return true;
    }
}

