学习笔记

- 泛型递归、树形递归

- 分治、回溯(su第4声)

    - 1.DFS 和回溯算法区别
 
      DFS 是一个劲的往某一个方向搜索，而回溯算法建立在 DFS 基础之上的，但不同的是在搜索过程中，达到结束条件后，恢复状态，回溯上一层，再次搜索。因此回溯算法与 DFS 的区别就是有无状态重置
   
    - 2.何时使用回溯算法
  
      当问题需要 "回头"，以此来查找出所有的解的时候，使用回溯算法。即满足结束条件或者发现不是正确路径的时候(走不通)，要撤销选择，回退到上一个状态，继续尝试，直到找出所有解为止
  
    - 3.怎么样写回溯算法(从上而下，※代表难点，根据题目而变化)
    
          ①画出递归树，找到状态变量(回溯函数的参数)，这一步非常重要※
          ②根据题意，确立结束条件
          ③找准选择列表(与函数参数相关),与第一步紧密关联※
          ④判断是否需要剪枝
          ⑤作出选择，递归调用，进入下一层
          ⑥撤销选择
          
    - 4.回溯问题的类型
    
    类型|	题目链接|
    ---|    ---|
    子集、组合|	子集、子集 II、组合、组合总和、组合总和 II
    全排列|	全排列、全排列 II、字符串的全排列、字母大小写全排列
    搜索|解数独、单词搜索、N皇后、分割回文串、二进制手表
   
> 注意：子集、组合与排列是不同性质的概念。子集、组合是无关顺序的，而排列是和元素顺序有关的，如 [1，2] 和 [2，1] 是同一个组合(子集)，但 [1,2] 和 [2,1] 是两种不一样的排列！！！！因此被分为两类问题
