<?php

ini_set('memory_limit', "-1");
ini_set('max_execution_time', "120");

$states = file_get_contents('inputs/day6.txt');

//$states = '3,4,3,1,2';
$fishes = explode(',', $states);
$fishes = array_count_values(array_map(static fn($age) => (int) $age, $fishes));
$day = 0;

$countedFishes = [
    0 => 0,
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
];

foreach ($fishes as $index => $fish) {
    $countedFishes[$index] += $fish;
}

for ($iterator = 0; $iterator < 256; $iterator++) {
    $countedFishes = advanceDay($countedFishes);
    echo 'Increasing the day!' . PHP_EOL;
}

echo 'The total amount of fishes after 80 days: ' . array_sum($countedFishes) . PHP_EOL;

function advanceDay(array $fishes)
{
    $newFishes = $fishes[0];
    $fishes[0] = $fishes[1];
    $fishes[1] = $fishes[2];
    $fishes[2] = $fishes[3];
    $fishes[3] = $fishes[4];
    $fishes[4] = $fishes[5];
    $fishes[5] = $fishes[6];
    $fishes[6] = $fishes[7] + $newFishes;
    $fishes[7] = $fishes[8];
    $fishes[8] = $newFishes;

    return $fishes;
}