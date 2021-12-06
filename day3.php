<?php

$diagnostics = file('inputs/day3.txt');

//$diagnostics = [
//    '00100',
//    '11110',
//    '10110',
//    '10111',
//    '10101',
//    '01111',
//    '00111',
//    '11100',
//    '10000',
//    '11001',
//    '00010',
//    '01010',
//];

$gamma = '';
$epsilon = '';
$splitDiagnostics = [];
$values = [];
$strLength = 0;

foreach ($diagnostics as $diagnostic) {
    $splitDiagnostics[] = str_split($diagnostic);
    $strLength = strlen($diagnostic);
}

// This for loop runs one time for each letter of each string
for ($iterator = 0; $iterator < $strLength; $iterator++) {
    $values[$iterator] = array_count_values(array_column($splitDiagnostics, $iterator));
    if ($values[$iterator][0] < $values[$iterator][1]) {
        $gamma .= '1';
        $epsilon .= '0';
    } else {
        $gamma .= '0';
        $epsilon .= '1';
    }
}

function onlyDiagnosticsOxygen(int $position, array $diagnostics, int $strLength): array
{
    if (count($diagnostics) > 1 && $position < $strLength) {
        $values = array_count_values(array_column($diagnostics, $position));
        if ($values[0] === $values[1] || $values[1] > $values[0]) {
            $keep = '1';
        } else {
            $keep = '0';
        }
        $diagnostics = array_filter($diagnostics, function($bits) use ($keep, $position) {
            return $bits[$position] === $keep;
        });
    } else {
        return $diagnostics[array_key_first($diagnostics)];
    }

    return onlyDiagnosticsOxygen(++$position, $diagnostics, $strLength);
}

function onlyDiagnosticsCO2(int $position, array $diagnostics, int $strLength): array
{
    if (count($diagnostics) > 1 && $position < $strLength) {
        $values = array_count_values(array_column($diagnostics, $position));
        if ($values[0] === $values[1] || $values[1] > $values[0]) {
            $keep = '0';
        } else {
            $keep = '1';
        }
        $diagnostics = array_filter($diagnostics, function($bits) use ($keep, $position) {
            return $bits[$position] === $keep;
        });
    } else {
        return $diagnostics[array_key_first($diagnostics)];
    }

    return onlyDiagnosticsCO2(++$position, $diagnostics, $strLength);
}

// Only use the first bit of each diagnostics number
// Keep only the numbers that are in these crits:
// Oxygen: determine most common value, keep only the diagnostic number that has this as first bit
// If equally common, keep all with 1 as first bit
// CO2: determine least common value, keep only the diagnostic number that has this as first bit
// If equally common, keep all with 0 as first bit

echo $gamma . PHP_EOL;
echo $epsilon . PHP_EOL;
echo bindec($gamma) . PHP_EOL;
echo bindec($epsilon) . PHP_EOL;

$oxygen = onlyDiagnosticsOxygen(0, $splitDiagnostics, $strLength);
$oxygen = implode('', $oxygen);
$co2 = onlyDiagnosticsCO2(0, $splitDiagnostics, $strLength);
$co2 = implode('', $co2);

echo $oxygen . PHP_EOL;
echo $co2 . PHP_EOL;
echo bindec($oxygen) . PHP_EOL;
echo bindec($co2) . PHP_EOL;

echo 'Power consumption: ' . bindec($gamma) * bindec($epsilon) . PHP_EOL;
echo 'Life support rating: ' . bindec($oxygen) * bindec($co2);
