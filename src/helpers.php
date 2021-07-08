<?php

namespace Duffleman\crpc;

use Jawira\CaseConverter\Convert;

function anyToSnake($input)
{
    // convert in and out of JSON to make a specific type
    // because god knows what you're entering here
    $input = \Duffleman\JSONClient\decode(\Duffleman\JSONClient\encode($input));

    return quickRecursive($input, function (string $i) {
        $c = new Convert($i);

        return $c->toSnake();
    });
}

function anyToCamel($input)
{
    // convert in and out of JSON to make a specific type
    // because god knows what you're entering here
    $input = \Duffleman\JSONClient\decode(\Duffleman\JSONClient\encode($input));

    return quickRecursive($input, function (string $i) {
        $c = new Convert($i);

        return $c->toCamel();
    });
}

function quickRecursive(string | array $i, callable $quickFunc)
{
    $out = [];

    if (is_string($i)) {
        return $quickFunc($i);
    }

    foreach ($i as $k => $v) {
        if (is_array($v)) {
            $out[$quickFunc($k)] = quickRecursive($v, $quickFunc);
        } else {
            $out[$quickFunc($k)] = $v;
        }
    }

    return $out;
}
