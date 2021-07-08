# json-client

crpc for PHP, styled from [billinghamj/crpc](https://github.com/billinghamj/crpc).

## About

[JSONClient](https://github.com/Duffleman/json-client) is cool and all but this is opinionated to the crpc standard.

## Basic Usage

```php
<?php

require_once 'vendor/autoload.php';

use Duffleman\crpc;

// important trailing slash here
$c = new crpc\crpc('https://api.avocado.cuv-nonprod.app/1/service-staff/', [
    'headers' => ['Authorization' => '... keys here'],
]);

$res = $c->do('1/latest/list_staff', [
    'showPastEmployees' => true, // converted to snake case
]);

foreach ($res as $staff) {
    $staff = (object) $staff;
    $staff->about = (object) $staff->about; // only because I prefer -> to array accessors

    if (!$staff->isActive) { // converted from snake case
        echo '!! ';
    }
    echo "{$staff->about->name} ({$staff->about->role})";
    echo "\n";
}

```
