<?php

namespace App;

use App\Exceptions\FileAccessException;

class CsvSitemapGenerator extends AbstractSitemapGenerator
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
            fputcsv($file, $page);
        }

        fclose($file);
    }
}
