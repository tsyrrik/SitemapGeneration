<?php

namespace App\Validation;

use App\Exceptions\InvalidDataException;

class FileValidator
{
    public static function validateExtension(string $filePath, string $expectedExtension): void
    {
        $actualExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        if (strtolower($actualExtension) !== strtolower($expectedExtension)) {
            throw new InvalidDataException("Ожидалось расширение файла .$expectedExtension, получено .$actualExtension");
        }
    }
}
