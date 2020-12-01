# php-long-poll
Php long polling class example.

## Usage

```php
$checkfunc = function() use () {
    // long polling checkfunc.
    $current = rand(10,100);
    if ($current !== 10) {
        return true;
    } else {
        return false;
    }
};

$returnfunc = function() use () {
    // something to return.
    return true;
};

$longpoll = new long_poll($checkfunc, $returnfunc, 1);
```
