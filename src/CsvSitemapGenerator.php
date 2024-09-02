<?php

namespace App;

use App\Validation\FileValidator;
use App\Exceptions\FileAccessException;
use App\Exceptions\InvalidDataException;

class CsvSitemapGenerator extends AbstractSitemapGenerator
{
    public function generate(array $pages, string $filePath): void
    {
        // Проверка расширения файла
        FileValidator::validateExtension($filePath, 'csv');

        $this->createDirectoryIfNotExists($filePath);

        $file = fopen($filePath, 'w');
        if ($file === false) {
            throw new FileAccessException('Не удалось открыть CSV файл: ' . $filePath);
        }

        foreach ($pages as $page) {
            if (fputcsv($file, $page) === false) {
                throw new InvalidDataException('Ошибка записи в CSV файл: ' . $filePath);
            }
        }

        fclose($file);
    }
}
