<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$myParallelizedFunction = function (int $childNumber, array $packages, $optionalExtraParameter) {
    echo "Thread $childNumber: " . implode(', ', $packages) . " of $optionalExtraParameter\n";

    sleep($childNumber * 1);

    echo "Finished Thread $childNumber.\n";
};

$states = [
    'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
    'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho',
];

$runner = new BettergistCollective\ConcurrencyHelper\ConcurrencyHelper();
$runner->concurrentlyRun($states, 6, $myParallelizedFunction, [count($states)]);

