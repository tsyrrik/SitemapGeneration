<?php

namespace App;

use App\Exceptions\FileAccessException;
use App\Exceptions\InvalidDataException;

class JsonSitemapGenerator extends AbstractSitemapGenerator
{
    public function generate(array $pages, string $filePath): void
    {
        $this->createDirectoryIfNotExists($filePath);

        $jsonContent = json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($jsonContent === false) {
            throw new InvalidDataException('Ошибка кодирования JSON: ' . json_last_error_msg());
        }

        if (file_put_contents($filePath, $jsonContent) === false) {
            throw new FileAccessException('Не удалось сохранить JSON файл: ' . $filePath);
        }
    }
}
