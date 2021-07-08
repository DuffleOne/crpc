<?php

namespace Duffleman\crpc;

use Duffleman\JSONClient\JSONClient;

class crpc
{
    protected $client;
    protected static string $version = '1.0.0';
    protected float $timeout = 10;

    public function __construct(string $base_url, array $opts = [])
    {
        $this->global_headers['User-Agent'] = \GuzzleHttp\default_user_agent().' crpc/'.self::$version;

        $this->client = new JSONClient($base_url, $opts);
    }

    public function do(string $path, array | Countable $body)
    {
        if (!empty($body)) {
            $body = anyToSnake($body);
        }

        $out = $this->client->request('POST', $path, $body);

        return anyToCamel($out);
    }
}
