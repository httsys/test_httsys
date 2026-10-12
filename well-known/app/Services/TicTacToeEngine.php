<?php

namespace App\Services;

/**
 * Pure Tic Tac Toe rules and the computer opponent. No database, no Laravel -
 * everything works on a board string with one character per cell:
 * "-" empty, "X", "O". Cells are numbered row by row, starting at 0.
 */
class TicTacToeEngine
{
    /** Board size => how many in a row win. */
    public static $winLengths = [3 => 3, 5 => 4, 7 => 5];

    public static function isValidSize($size)
    {
        return isset(self::$winLengths[(int) $size]);
    }

    public static function winLength($size)
    {
        return self::$winLengths[(int) $size];
    }

    public static function emptyBoard($size)
    {
        return str_repeat('-', ((int) $size) * ((int) $size));
    }

    /**
     * Look at the board.
     *
     * @return array ['status' => 'playing'|'win'|'draw', 'symbol' => 'X'|'O'|null, 'cells' => int[]]
     */
    public static function evaluate($board, $size, $winLen)
    {
        $size = (int) $size;
        $winLen = (int) $winLen;
        $dirs = [[0, 1], [1, 0], [1, 1], [1, -1]];

        for ($r = 0; $r < $size; $r++) {
            for ($c = 0; $c < $size; $c++) {
                $s = $board[$r * $size + $c];
                if ($s === '-') {
                    continue;
                }

                foreach ($dirs as $d) {
                    $pr = $r - $d[0];
                    $pc = $c - $d[1];
                    // Only start counting at the beginning of a run.
                    if ($pr >= 0 && $pr < $size && $pc >= 0 && $pc < $size && $board[$pr * $size + $pc] === $s) {
                        continue;
                    }

                    $cells = [];
                    $rr = $r;
                    $cc = $c;
                    while ($rr >= 0 && $rr < $size && $cc >= 0 && $cc < $size && $board[$rr * $size + $cc] === $s) {
                        $cells[] = $rr * $size + $cc;
                        $rr += $d[0];
                        $cc += $d[1];
                    }

                    if (count($cells) >= $winLen) {
                        return ['status' => 'win', 'symbol' => $s, 'cells' => $cells];
                    }
                }
            }
        }

        if (strpos($board, '-') === false) {
            return ['status' => 'draw', 'symbol' => null, 'cells' => []];
        }

        return ['status' => 'playing', 'symbol' => null, 'cells' => []];
    }

    public static function emptyCells($board)
    {
        $out = [];
        $len = strlen($board);
        for ($i = 0; $i < $len; $i++) {
            if ($board[$i] === '-') {
                $out[] = $i;
            }
        }

        return $out;
    }

    public static function place($board, $cell, $symbol)
    {
        $board[$cell] = $symbol;

        return $board;
    }

    public static function other($symbol)
    {
        return $symbol === 'X' ? 'O' : 'X';
    }

    /**
     * The computer's move.
     *
     * $mistakePercent: chance (0-100) that it plays a random free cell instead
     * of its best move - this is what lets the player win.
     */
    public static function computerMove($board, $size, $winLen, $ai, $mistakePercent)
    {
        $empty = self::emptyCells($board);
        if (! $empty) {
            return null;
        }

        $mistakePercent = max(0, min(100, (int) $mistakePercent));
        if ($mistakePercent > 0 && mt_rand(1, 100) <= $mistakePercent) {
            return $empty[array_rand($empty)];
        }

        if ((int) $size === 3) {
            return self::minimaxMove($board, $size, $winLen, $ai);
        }

        return self::heuristicMove($board, $size, $winLen, $ai);
    }

    /* ---------------- 3x3: perfect play ---------------- */

    protected static function minimaxMove($board, $size, $winLen, $ai)
    {
        $best = null;
        $bestScore = -1000;
        $moves = [];

        foreach (self::emptyCells($board) as $cell) {
            $score = self::minimax(self::place($board, $cell, $ai), $size, $winLen, $ai, self::other($ai), 1, -1000, 1000);
            if ($score > $bestScore) {
                $bestScore = $score;
                $moves = [$cell];
            } elseif ($score === $bestScore) {
                $moves[] = $cell;
            }
        }

        return $moves ? $moves[array_rand($moves)] : null;
    }

    protected static function minimax($board, $size, $winLen, $ai, $toMove, $depth, $alpha, $beta)
    {
        $e = self::evaluate($board, $size, $winLen);
        if ($e['status'] === 'win') {
            return $e['symbol'] === $ai ? 10 - $depth : $depth - 10;
        }
        if ($e['status'] === 'draw') {
            return 0;
        }

        if ($toMove === $ai) {
            $best = -1000;
            foreach (self::emptyCells($board) as $cell) {
                $v = self::minimax(self::place($board, $cell, $toMove), $size, $winLen, $ai, self::other($toMove), $depth + 1, $alpha, $beta);
                $best = max($best, $v);
                $alpha = max($alpha, $best);
                if ($beta <= $alpha) {
                    break;
                }
            }

            return $best;
        }

        $best = 1000;
        foreach (self::emptyCells($board) as $cell) {
            $v = self::minimax(self::place($board, $cell, $toMove), $size, $winLen, $ai, self::other($toMove), $depth + 1, $alpha, $beta);
            $best = min($best, $v);
            $beta = min($beta, $best);
            if ($beta <= $alpha) {
                break;
            }
        }

        return $best;
    }

    /* ---------------- 5x5 / 7x7: win, block, then best line ---------------- */

    protected static function heuristicMove($board, $size, $winLen, $ai)
    {
        $human = self::other($ai);
        $empty = self::emptyCells($board);

        // 1. Win now.
        foreach ($empty as $cell) {
            if (self::evaluate(self::place($board, $cell, $ai), $size, $winLen)['status'] === 'win') {
                return $cell;
            }
        }

        // 2. Stop the opponent winning next move.
        foreach ($empty as $cell) {
            if (self::evaluate(self::place($board, $cell, $human), $size, $winLen)['status'] === 'win') {
                return $cell;
            }
        }

        // 3. Score every free cell by the winning lines it sits on.
        $windows = self::windows($size, $winLen);
        $scores = [];
        foreach ($empty as $cell) {
            $scores[$cell] = 0;
        }

        foreach ($windows as $w) {
            $mine = 0;
            $theirs = 0;
            foreach ($w as $i) {
                if ($board[$i] === $ai) {
                    $mine++;
                } elseif ($board[$i] === $human) {
                    $theirs++;
                }
            }

            if ($mine > 0 && $theirs > 0) {
                continue; // a dead line
            }

            $value = $theirs === 0 ? pow(8, $mine) : 0.9 * pow(8, $theirs);
            foreach ($w as $i) {
                if ($board[$i] === '-') {
                    $scores[$i] += $value;
                }
            }
        }

        $centre = ($size - 1) / 2;
        $best = [];
        $bestScore = -1;
        foreach ($scores as $cell => $score) {
            $r = intdiv($cell, $size);
            $c = $cell % $size;
            $score += 2 - (abs($r - $centre) + abs($c - $centre)) * 0.3;
            if ($score > $bestScore + 0.0001) {
                $bestScore = $score;
                $best = [$cell];
            } elseif (abs($score - $bestScore) <= 0.0001) {
                $best[] = $cell;
            }
        }

        return $best[array_rand($best)];
    }

    /**
     * Every run of $winLen cells in a row / column / diagonal.
     */
    protected static function windows($size, $winLen)
    {
        $out = [];
        $dirs = [[0, 1], [1, 0], [1, 1], [1, -1]];

        for ($r = 0; $r < $size; $r++) {
            for ($c = 0; $c < $size; $c++) {
                foreach ($dirs as $d) {
                    $endR = $r + $d[0] * ($winLen - 1);
                    $endC = $c + $d[1] * ($winLen - 1);
                    if ($endR < 0 || $endR >= $size || $endC < 0 || $endC >= $size) {
                        continue;
                    }

                    $w = [];
                    for ($k = 0; $k < $winLen; $k++) {
                        $w[] = ($r + $d[0] * $k) * $size + ($c + $d[1] * $k);
                    }
                    $out[] = $w;
                }
            }
        }

        return $out;
    }
}
