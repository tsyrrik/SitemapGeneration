<?php

namespace App;

use App\Exceptions\FileAccessException;
use App\Exceptions\InvalidDataException;
use SimpleXMLElement;

class XmlSitemapGenerator implements SitemapGeneratorInterface
{
    public function generate(array $pages, string $filePath): void
    {
        $this->createDirectoryIfNotExists($filePath);

        $xml = new SimpleXMLElement('<urlset/>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($pages as $page) {
            if (!isset($page['loc']) || !isset($page['lastmod']) || !isset($page['priority']) || !isset($page['changefreq'])) {
                throw new InvalidDataException();
            }
            $url = $xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($page['loc'], ENT_XML1));
            $url->addChild('lastmod', $page['lastmod']);
            $url->addChild('priority', $page['priority']);
            $url->addChild('changefreq', $page['changefreq']);
        }

        $xmlContent = $xml->asXML();
        if ($xmlContent === false) {
            throw new InvalidDataException('Ошибка создания XML');
        }

        if (file_put_contents($filePath, $xmlContent) === false) {
            throw new FileAccessException('Не удалось сохранить XML файл: ' . $filePath);
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
