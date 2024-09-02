<?php

namespace App;

use App\Validation\FileValidator;
use App\Exceptions\FileAccessException;
use App\Exceptions\InvalidDataException;
class XmlSitemapGenerator extends AbstractSitemapGenerator
{
    public function generate(array $pages, string $filePath): void
    {
        // Проверка расширения файла
        FileValidator::validateExtension($filePath, 'xml');

        $this->createDirectoryIfNotExists($filePath);

        $xml = new SimpleXMLElement('<urlset/>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($pages as $page) {
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
}
