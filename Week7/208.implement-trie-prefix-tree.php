<?php

class Trie2
{
    /**
     * Initialize your data structure here.
     */
    function __construct()
    {
        $this->isEnd = false;
        //$this->children = array_fill(0, 26, null); //这种也可以 感觉有点浪费
        $this->children = [];
    }

    /**
     * Inserts a word into the trie.
     * @param String $word
     * @return NULL
     */
    function insert($word)
    {
        $node = $this;
        for ($i = 0; $i < strlen($word); $i++) {
            $index = ord($word[$i]) - ord('a');
            if (!isset($node->children[$index])) {
                $node->children[$index] = new Trie();
            }
            //每个节点都是必须要有的
            $node = $node->children[$index];
        }
        $node->isEnd = true;
    }

    /**
     * Returns if the word is in the trie.
     * @param String $word
     * @return Boolean
     */
    function search($word)
    {
        $node = $this;
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
        $node = $this;
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

/**
 * 将节点分出来 执行更快 占用空间更少
 * Class TrieNode
 */
class TrieNode
{
    public $isEnd = false;
    public $children = [];
}

/**
 * Your Trie object will be instantiated and called as such:
 * $obj = Trie();
 * $obj->insert($word);
 * $ret_2 = $obj->search($word);
 * $ret_3 = $obj->startsWith($prefix);
 */

$obj = new Trie();
$obj->insert('apple');
//$obj->insert('apc');
//print_r($obj);
var_dump($obj->search('apple')); //true
var_dump($obj->search('app')); //false
var_dump($obj->startsWith('app')); //true
$obj->insert('app');
var_dump($obj->search('app')); //true
