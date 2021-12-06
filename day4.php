<?php

declare(strict_types=1);

$lines = file('inputs/input.txt');

//$lines = [
//    '7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1',
//    '',
//    '22 13 17 11  0',
//    '8  2 23  4 24',
//    '21  9 14 16  7',
//    '6 10  3 18  5',
//    '1 12 20 15 19',
//    '',
//    '3 15  0  2 22',
//    '9 18 13 17  5',
//    '19  8  7 25 23',
//    '20 11 10 24  4',
//    '14 21 16 12  6',
//    '',
//    '14 21 17 24  4',
//    '10 16 15  9 19',
//    '18  8 23 26 20',
//    '22 11 13  6  5',
//    '2  0 12  3  7',
//];

function partOne(array $lines)
{
    // Numbers to draw
    $drawPile = explode(',', array_shift($lines));
    // Numbers that have been drawn
    $drawn = [];
    // Bingo boards
    $boards = [];
    $eliminatedBoards = [];
    $currentBoard = null;

    // Create boards
    foreach ($lines as $line) {
        // Empty lines mark the beginning of a new board
        if (empty(trim($line))) {
            // Add board to boards collection
            if ($currentBoard !== null) {
                $boards[] = $currentBoard;
            }
            // Reset current board and move on
            $currentBoard = [];
            continue;
        }
        $currentBoard[] = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
    }
    if (! empty($currentBoard)) {
        $boards[] = $currentBoard;
        unset($currentBoard);
    }

    var_dump(count($boards));

    // What's next:
    // Pull the first number of the draw pile, and mark it on all boards
    foreach ($drawPile as $item) {
        $drawn[] = $item;
        $boards = checkOffMark($boards, $item);
        $winner = checkWinner($boards, $eliminatedBoards);

        if ($winner !== false) {
            $eliminatedBoards[$winner] = $boards[$winner];
            unset($boards[$winner]);
//            die();
            echo '==============================================' . PHP_EOL;
            var_dump(count($eliminatedBoards));

//            if (count($boards) === 1) {
//                var_dump($boards);
//            }
//            $finalScore = calculateFinalScore($boards, $winner);
//            $puzzleScore = $finalScore * end($drawn);
            echo 'Winning board: ' . $winner . PHP_EOL;
            echo 'Last number: ' . end($drawn) . PHP_EOL;
//            echo 'Final score: ' . $finalScore . PHP_EOL;
//            echo 'Puzzlescore: ' . $puzzleScore . PHP_EOL;
        }
    }
    die();
}

function checkOffMark(array $boards, $item)
{
    foreach ($boards as &$board) {
        // Check for horizontal lines that are marked with *
        foreach ($board as &$row) {
            foreach ($row as &$number) {
                if ($number === $item) {
                    $number = '*';
                }
            }
        }
    }
    return $boards;
}

function checkWinner(array &$boards, array &$eliminatedBoards)
{
    foreach ($boards as $index => $board) {
        // Check for horizontal lines that are marked with *
        foreach ($board as $rowIndex => $row) {
            $rowCounter = 0;
            foreach ($row as $rowNumber) {
                if (str_starts_with('*', $rowNumber)) {
                    $rowCounter++;
                }
            }

            if ($rowCounter === 5) {
                echo "Winning by row $rowIndex\n";
                return $index;
            }
        }
        // Check for vertical lines that are marked with *
        for ($iterator = 0; $iterator < 5; $iterator++) {
            $column = array_column($board, $iterator);

            $columnCounter = 0;
            foreach ($column as $columnNumber) {
                if ($columnNumber === '*') {
                    $columnCounter++;
                }
            }
            // Winner winner
            if ($columnCounter === 5) {
                echo "Winning by column $iterator\n";
                return $index;
            }
        }
    }

    return false;
}

function calculateFinalScore(array $boards, $winner): int
{
    $sum = 0;
    foreach ($boards[$winner] as $row) {
        $sum += array_sum($row);
    }

    return $sum;
}

function partTwo(array $lines)
{
}

echo partOne($lines) . PHP_EOL;
echo partTwo($lines) . PHP_EOL;
