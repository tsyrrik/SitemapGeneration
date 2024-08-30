<?php

namespace App\Exceptions;

use Exception;

class FileAccessException extends Exception
{
    protected $message = 'Ошибка доступа записи к файлу.';
}
