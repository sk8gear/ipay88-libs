<?php

namespace IPay88\Exceptions;

use Exception;

class InvalidSignatureException extends Exception
{
	protected $message = 'Invalid Signature';
}