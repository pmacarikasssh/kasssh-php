<?php

namespace Kasssh\Payment\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;

class InvalidApiResponse extends Exception {
    public $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        parent::__construct($response->getBody(), $response->getStatusCode());
    }
}

