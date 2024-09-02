<?php

namespace App;

use Exception;

class SitemapGeneratorFactory
{
    public static function create(string $type): SitemapGeneratorInterface
    {
        switch (strtolower($type)) {
            case 'xml':
                return new XmlSitemapGenerator();
            case 'csv':
                return new CsvSitemapGenerator();
            case 'json':
                return new JsonSitemapGenerator();
            default:
                throw new Exception('Неподдерживаемый тип ' . $type);
        }
    }
}
