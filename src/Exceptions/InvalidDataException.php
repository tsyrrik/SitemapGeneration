<?php

namespace App\Exceptions;

use Exception;

class InvalidDataException extends Exception
{
    protected $message = 'Невалидные данные при инициализации парсинга.';
}
