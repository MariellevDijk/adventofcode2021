<?php

ini_set('memory_limit', "-1");
ini_set('max_execution_time', "5000");

//$states = file_get_contents('fishes2.txt');
$states = '3,4,3,1,2';

$fishes = explode(',', $states);
$fishes = array_map(static fn($age) => (int) $age, $fishes);
$day = 0;

//var_dump($fishes);

function createFish(array &$fishes)
{
    return $fishes[] = 8;
}

function advanceDay(array $fishes)
{
    $newFishes = 0;
    foreach ($fishes as &$fish) {
        $newCount = [

        ];
//        echo '  ====================================' . PHP_EOL;
//        echo '  Found a fish! Age: ' . $fish . PHP_EOL;
        --$fish;
//        echo '  This fish is now:' . $fish . PHP_EOL;
        if ($fish === -1) {
//            echo '      Spawning a new fish' . PHP_EOL;
            $newFishes++;
            $fish = 6;
        }
//        echo '  ====================================' . PHP_EOL;
    }

    for ($iterator = 0; $iterator < $newFishes; $iterator++) {
        createFish($fishes);
    }
    return $fishes;
}

for ($iterator = 0; $iterator < 64; $iterator++) {
    $fishes = advanceDay($fishes);
//    echo 'Increasing the day!' . PHP_EOL;
}

var_dump(count($fishes));