学习笔记

#### 时间与空间复杂度

#### 数据结构
- 数组、链表、跳表

        数组
        prepend  =>  O(1)
        append   =>  O(1)
        lookup   =>  O(1) 
        insert   =>  O(n)
        delete   =>  O(n)
        正常情况下数组的 prepend 操作的时间复杂度是O(n) ,但是可以进行特殊优化到O(1)。
        采用的方式时申请稍大一些的内存空间，然后再数组最开始预留一部分空间，然后prepend的操作则是把头下标前移一个位置即可。
        
        链表
        prepend  =>  O(1)
        append   =>  O(1)
        lookup   =>  O(n)  随机访问  
        insert   =>  O(1)
        delete   =>  O(1)
        
        3.跳表
        跳表的空间复杂度是O(n, 实际节点肯定是要比原节点要多的
        再跳表中查询任意数据的时间复杂度就是O(logn)

- 栈、队列、双端队列、优先队列



`测试` 
<font color=red> red 