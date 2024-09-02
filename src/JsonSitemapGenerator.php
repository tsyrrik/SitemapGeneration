<?php

namespace App;

use App\Validation\FileValidator;
use App\Exceptions\FileAccessException;
use App\Exceptions\InvalidDataException;

class JsonSitemapGenerator extends AbstractSitemapGenerator
{
    public function generate(array $pages, string $filePath): void
    {
        // Проверка расширения файла
        FileValidator::validateExtension($filePath, 'json');

        $this->createDirectoryIfNotExists($filePath);

        $jsonContent = json_encode($pages, JSON_PRETTY_PRINT);
        if ($jsonContent === false) {
            throw new InvalidDataException('Ошибка создания JSON');
        }

        if (file_put_contents($filePath, $jsonContent) === false) {
            throw new FileAccessException('Не удалось сохранить JSON файл: ' . $filePath);
        }
    }
}
