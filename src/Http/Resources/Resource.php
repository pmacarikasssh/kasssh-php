<?php

namespace Kasssh\Payment\Http\Resources;

use Kasssh\Payment\KassshClient;

abstract class Resource
{
    protected $client;

    public function __construct(KassshClient $client)
    {
        $this->client = $client;
    }

    public static function make(...$args)
    {
        $client = new KassshClient(...$args);
        return new static($client);
    }
}
