<?php

namespace Kasssh\Payment\Exceptions;

use Exception;

class InvalidResource extends Exception {
    public function __construct()
    {
        parent::__construct("Resource Not supported");
    }
}

