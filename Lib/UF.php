<?php

class UF
{
    function __construct($n)
    {
        $this->count = 0; //连通分量
        $this->parent = []; // 森林
        $this->size = []; // 树大小
        for ($i = 0; $i < $n; $i++) {
            $this->parent[$i] = $i;
            $this->size[$i] = 1;
            $this->count++;
        }
    }

    function find($x)
    {
        while ($this->parent[$x] != $x) {
            $this->parent[$x] = $this->parent[$this->parent[$x]];
            $x = $this->parent[$x];
        }
        return $x;
    }

    function union($p, $q)
    {
        $rootP = $this->find($p);
        $rootQ = $this->find($q);
        if ($rootP == $rootQ) return;

        if ($this->size[$rootP] > $this->size[$rootQ]) {
            $this->parent[$rootQ] = $rootP;
            $this->size[$rootP] += $this->size[$rootQ];
        } else {
            $this->parent[$rootP] = $rootQ;
            $this->size[$rootQ] += $this->size[$rootP];
        }
        $this->count--;
    }

    function isConnected($p, $q)
    {
        return $this->find($p) == $this->find($q);
    }

    function count()
    {
        return $this->count;
    }
}