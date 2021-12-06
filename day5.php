<?php

//$lines = file('inputs/day5.txt');

$lines = [
    '0,9 -> 5,9', // Geldig, 6 chars
    '8,0 -> 0,8', // Diagonal
    '9,4 -> 3,4', // Geldig, 7 chars
    '2,2 -> 2,1', // Geldig, 2 chars
    '7,0 -> 7,4', // Geldig, 5 chars
    '6,4 -> 2,0', // Diagonal
    '0,9 -> 2,9', // Geldig, 3 chars
    '3,4 -> 1,4', // Geldig, 3 chars
    '0,0 -> 8,8', // Diagonal
    '5,5 -> 8,2', // Diagonal
];

$validLines = [];
$calculatedLines = [];
$diagonalLines = [];

echo 'Amount of all lines: ' . count($lines) . PHP_EOL;

foreach ($lines as $line) {
    $segments = explode(' -> ', trim($line));
    $segments = array_map(fn($segment) => explode(',', $segment), $segments);
    $x1 = $segments[0][0];
    $x2 = $segments[1][0];
    $y1 = $segments[0][1];
    $y2 = $segments[1][1];

    if ($x1 === $x2 || $y1 === $y2) {
        $validLines[] = $segments;
    } else {
        $diagonalLines[] = $segments;
    }
}

echo 'Amount of valid lines: ' . count($validLines) . PHP_EOL;
echo 'Amount of diagonal lines: ' . count($diagonalLines) . PHP_EOL;

foreach ($validLines as $index => $validLine) {
    $x1 = $validLine[0][0];
    $x2 = $validLine[1][0];
    $y1 = $validLine[0][1];
    $y2 = $validLine[1][1];
    if ($x1 !== $x2) {
        foreach (preg_filter('/$/', ',' . $y2, range($x1, $x2)) as $calculatedLine) {
            $calculatedLines[] = $calculatedLine;
        }
    } elseif ($y1 !== $y2) {
        foreach (preg_filter('/^/', $x1 . ',', range($y1, $y2)) as $calculatedLine) {
            $calculatedLines[] = $calculatedLine;
        }
    }
}

foreach ($diagonalLines as $diagonalLine) {
    $x1 = $diagonalLine[0][0];
    $x2 = $diagonalLine[1][0];
    $y1 = $diagonalLine[0][1];
    $y2 = $diagonalLine[1][1];

    $yAs = range($y1, $y2);
    foreach (range($x1, $x2) as $index => $xAs) {
        $calculatedLines[] = $xAs . ',' . $yAs[$index];
    }
}

var_dump($calculatedLines);

echo 'Amount of calculated lines: ' . count($calculatedLines) . PHP_EOL;
$crosses = count(array_filter(array_count_values($calculatedLines), fn($c) => $c >= 2));
echo 'Total overlaps: ' . $crosses . PHP_EOL;