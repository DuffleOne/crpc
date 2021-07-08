<?php

require_once 'vendor/autoload.php';

use Duffleman\crpc;

$c = new crpc\crpc('https://api.prod.cuv-prod.app/1/service-staff/', [
    'headers' => ['Authorization' => '... keys here'],
]);

$res = $c->do('1/latest/list_staff', [
    'showPastEmployees' => true,
]);

foreach ($res as $staff) {
    $staff = (object) $staff;
    $staff->about = (object) $staff->about;

    if (!$staff->isActive) {
        echo '!! ';
    }
    echo "{$staff->about->name} ({$staff->about->role})";
    echo "\n";
}
