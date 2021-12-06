<?php

$depths = file('inputs/day1.txt');
$depths = array_map(static fn($ln) => (int) $ln, $depths);

//$depths = [
//    199,
//    200,
//    208,
//    210,
//    200,
//    207,
//    240,
//    269,
//    260,
//    263,
//];

$previousValue = null;
$increases = 0;

foreach ($depths as $depth) {
    if ($previousValue !== null && $previousValue < $depth) {
        $increases++;
    }
    $previousValue = $depth;
}

echo 'Increases: ' . $increases . PHP_EOL;

$increasesWindow = 0;

for ($i = 0; $i < (count($depths) - 3); $i++) {
    $windowA = [
        $depths[$i],
        $depths[$i + 1],
        $depths[$i + 2],
    ];
    $windowB = [
        $depths[$i + 1],
        $depths[$i + 2],
        $depths[$i + 3],
    ];

    if (array_sum($windowA) < array_sum($windowB)) {
        $increasesWindow++;
    }
}

echo 'Window Increases: ' . $increasesWindow . PHP_EOL;