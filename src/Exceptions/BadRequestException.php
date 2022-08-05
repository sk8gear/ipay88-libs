<?php

namespace IPay88\Exceptions;

use Exceptions;

class BadRequestException extends Exceptions{

    public function __construct($message){
        $this->message = $message;
    }
}