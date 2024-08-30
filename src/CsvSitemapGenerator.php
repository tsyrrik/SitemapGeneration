<?php

namespace App;

use App\Exceptions\FileAccessException;
use App\Exceptions\InvalidDataException;

class CsvSitemapGenerator implements SitemapGeneratorInterface
{
    public function generate(array $pages, string $filePath): void
    {
        $this->createDirectoryIfNotExists($filePath);

        $file = fopen($filePath, 'w');
        if ($file === false) {
            throw new FileAccessException('Не удалось создать файл: ' . $filePath);
        }

        fputcsv($file, ['loc', 'lastmod', 'priority', 'changefreq']);

        foreach ($pages as $page) {
            if (!isset($page['loc']) || !isset($page['lastmod']) || !isset($page['priority']) || !isset($page['changefreq'])) {
                throw new InvalidDataException();
            }
            fputcsv($file, $page);
        }

        fclose($file);
    }

    private function createDirectoryIfNotExists(string $filePath): void
    {
        $directory = dirname($filePath);
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777, true) && !is_dir($directory)) {
                throw new FileAccessException('Не удалось создать директорию: ' . $directory);
            }
        }
    }
}
