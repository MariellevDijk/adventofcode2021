<?php

$moves = file('inputs/day2.txt');

//$moves = [
//    'forward 5',
//    'down 5',
//    'forward 8',
//    'up 3',
//    'down 8',
//    'forward 2',
//];

$horizontal = 0;
$depth = 0;
$aim = 0;

foreach ($moves as $move) {
    $instructions = explode(' ', $move);
    $direction = $instructions[0];
    $strength = (int)$instructions[1];

    switch ($direction) {
        case 'forward':
           $horizontal += $strength;
           $depth += ($strength * $aim);
            break;
        case 'down':
            $aim += $strength;
            break;
        case 'up':
            $aim -= $strength;
            break;
    }
}

echo $horizontal . PHP_EOL;
echo $depth . PHP_EOL;

echo $horizontal * $depth;
