<?php

class Solution
{

    /**
     * BFS
     * @param String $start
     * @param String $end
     * @param String[] $bank
     * @return Integer
     */
    function minMutation($start, $end, $bank)
    {
        if (!in_array($end, $bank)) return -1;
        $bank = array_flip($bank);
        $queue = new SplQueue();
        $step = 0;
        $queue->enqueue([$start, $step]);
        while (!$queue->isEmpty()) {
            $size = $queue->count();
            $step++;
            for ($i = 0; $i < $size; $i++) {
                list($mid, $level) = $queue->dequeue();
                if ($mid == $end) return $level;
                for ($j = 0; $j < strlen($mid); $j++) {
                    $newMid = $mid;
                    foreach (['A', 'C', 'G', 'T'] as $char) {
                        $newMid[$j] = $char;
                        if (isset($bank[$newMid])) {
                            $queue->enqueue([$newMid, $level + 1]);
                            unset($bank[$newMid]);
                        }
                    }
                }
            }
        }
        return -1;
    }
}

/**
 * start: "AAAAACCC"
 * end:   "AACCCCCC"
 * bank: ["AAAACCCC", "AAACCCCC", "AACCCCCC"]
 * 返回值: 3
 */
$start = 'AAAAACCC';
$end = "AACCCCCC";
$bank = ["AAAACCCC", "AAACCCCC", "AACCCCCC"];

$s = new Solution();
$ret = $s->minMutation($start, $end, $bank);
print_r($ret);