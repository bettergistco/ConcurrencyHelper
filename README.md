# ConcurrencyHelper

ConcurrencyHelper is a library for easily and efficiently running any callable via multiple parallel PHP instances.

It's aim is to substantially simplify massively parallelized operations.

Notable use cases include the [Bettergist Collector project](https://gitlab.com/hopeseekr/bettergist-collector), which
uses ConcurrencyHelper to massively parallize the downloads of every www.Packagist.org package, using 50-200 PHP processes. 

**This library requires the ext-pcntl extension.**

https://github.com/bettergistco/ConcurrencyHelper

## Usage

    ```php
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
    ```

## Installation

Via Composer

``` bash
$ composer require phpexperts/conciseuuid
```

**This library requires the ext-pcntl extension.**

## Change log

Please see the [changelog](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please take a look at [contributing.md](contributing.md) if you want to make improvements.


## Credits

- Theodore R. Smith

## License

MIT license. Please see the [license file](license.md) for more information.


[ico-version]: https://img.shields.io/packagist/v/bettergist/concurrency-helper.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/bettergist/concurrency-helper.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/bettergist/concurrency-helper
[link-downloads]: https://packagist.org/packages/bettergist/concurrency-helper
[link-author]: https://github.com/hopeseekr
[link-contributors]: ../../contributors]
