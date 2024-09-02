<?php

namespace App;

use App\Exceptions\FileAccessException;

abstract class AbstractSitemapGenerator implements SitemapGeneratorInterface
{
    protected function createDirectoryIfNotExists(string $filePath): void
    {
        $directory = dirname($filePath);
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777, true) && !is_dir($directory)) {
                throw new FileAccessException('Не удалось создать директорию: ' . $directory);
            }
        }
    }

    abstract public function generate(array $pages, string $filePath): void;
}
