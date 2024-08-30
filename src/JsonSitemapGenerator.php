<?php

namespace App;

use App\Exceptions\FileAccessException;
use App\Exceptions\InvalidDataException;

class JsonSitemapGenerator implements SitemapGeneratorInterface
{
    public function generate(array $pages, string $filePath): void
    {
        $this->createDirectoryIfNotExists($filePath);

        foreach ($pages as $page) {
            if (!isset($page['loc']) || !isset($page['lastmod']) || !isset($page['priority']) || !isset($page['changefreq'])) {
                throw new InvalidDataException();
            }
        }

        $jsonContent = json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($jsonContent === false) {
            throw new InvalidDataException('Ошибка кодирования JSON: ' . json_last_error_msg());
        }

        if (file_put_contents($filePath, $jsonContent) === false) {
            throw new FileAccessException('Не удалось сохранить JSON файл: ' . $filePath);
        }
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
