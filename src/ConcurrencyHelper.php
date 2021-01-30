<?php declare(strict_types=1);

/**
 * This file is part of the Bettergist Collector Project.
 *
 * Copyright © 2019-2022 Theodore R. Smith <hopeseekr@gmail.com>
*    https://github.com/bettergistco/ConcurrencyHelper
 *   https://gitlab.com/hopeseekr/bettergist-collector
 *
 * This file is licensed under the MIT License.
 */

namespace BettergistCollective\ConcurrencyHelper;

class ConcurrencyHelper
{
    public function concurrentlyRun(array $packages, int $numberOfThreads, callable $parallelFunction, array $parallelArgs = [])
    {
        // Break into chunks, one chunk for each thread..
        $packageBoxes = [];
        foreach ($packages as $index => $package) {
            $packageBoxes[($index) % $numberOfThreads][] = $package;
        }

        // Spawn X children.
        foreach ($packageBoxes as $a => $packages) {
            if (($pid = pcntl_fork()) === -1) {
                exit("Error forking...\n");
            }

            // This is a child process. Give it a job.
            if ($pid === 0) {
                // Process 20% of the shuffled packages.
                $parallelFunction($a + 1, $packages, ...$parallelArgs);
                exit(0);
                return;
            }
        }

        // This while loop holds the parent process until all the child threads
        // are complete - at which point the script continues to execute.
        /* @noinspection PhpStatementHasEmptyBodyInspection */
        while (pcntl_waitpid(0, $status) != -1);
    }
}
