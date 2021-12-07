<?php
//$positions = file_get_contents('inputs/day7.txt');

$positions = '16,1,2,0,4,2,7,1,2,14';
$crabs = explode(',', $positions);
$crabs = array_map(static fn($position) => (int) $position, $crabs);

$maxPosition = max($crabs);
$minPosition = min($crabs);
$fuelNeeded = [];

for ($iterator = $minPosition; $iterator < $maxPosition; $iterator++) {
    $fuelCosts = 0;
    foreach ($crabs as $crab) {
        // Commented out code is for part 1
        // $fuelCosts += abs($iterator - $crab);
        $fuelCosts += array_sum(range(1, abs($iterator - $crab)));
        echo '-------------------------------------------' . PHP_EOL;
        echo 'Position crab: ' . $crab . PHP_EOL;
        echo 'Calculating for position: ' . $iterator . PHP_EOL;
        echo 'Fuel costs: ' . abs($crab - $iterator) . PHP_EOL;
        echo '-------------------------------------------' . PHP_EOL;
    }
    echo 'Cost of fuel moving to position ' . $iterator . ': ' . $fuelCosts . PHP_EOL;
    $fuelNeeded[] = $fuelCosts;
}

echo '-------------------------------------------' . PHP_EOL;
echo 'Least amount of fuel needed for this operation: ' . min($fuelNeeded) . PHP_EOL;
echo '-------------------------------------------' . PHP_EOL;
