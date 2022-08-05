<?php

namespace IPay88\Exceptions;

use Exception;

class DailyRequeryLimitException extends Exception
{
	protected $message = 'Maximum number of requery per day has reached';
}