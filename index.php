<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\SitemapGeneratorFactory;

try {
    $pages = [
        [
            'loc' => 'https://site.ru/',
            'lastmod' => '2020-12-14',
            'priority' => 1,
            'changefreq' => 'hourly',
        ],
        [
            'loc' => 'https://site.ru/news',
            'lastmod' => '2020-12-10',
            'priority' => 0.5,
            'changefreq' => 'daily',
        ],
        [
            'loc' => 'https://site.ru/about',
            'lastmod' => '2020-12-07',
            'priority' => 0.1,
            'changefreq' => 'weekly',
        ],
        [
            'loc' => 'https://site.ru/products',
            'lastmod' => '2020-12-12',
            'priority' => 0.5,
            'changefreq' => 'daily',
        ],
        [
            'loc' => 'https://site.ru/products/ps5',
            'lastmod' => '2020-12-11',
            'priority' => 0.1,
            'changefreq' => 'weekly',
        ],
        [
            'loc' => 'https://site.ru/products/xbox',
            'lastmod' => '2020-12-12',
            'priority' => 0.1,
            'changefreq' => 'weekly',
        ],
        [
            'loc' => 'https://site.ru/products/wii',
            'lastmod' => '2020-12-11',
            'priority' => 0.1,
            'changefreq' => 'weekly',
        ],
        [
            'loc' => 'https://site.ru/blog',
            'lastmod' => '2020-12-09',
            'priority' => 0.3,
            'changefreq' => 'monthly',
        ],
        [
            'loc' => 'https://site.ru/contact',
            'lastmod' => '2020-12-08',
            'priority' => 0.7,
            'changefreq' => 'yearly',
        ],
        [
            'loc' => 'https://site.ru/privacy-policy',
            'lastmod' => '2020-12-06',
            'priority' => 0.4,
            'changefreq' => 'never',
        ],
    ];

    $type = 'xml'; // 'csv', 'json'
    $filePath = '/var/www/site.ru/upload/sitemap.' . $type;

    // Создаем генератор с помощью фабрики
    $generator = SitemapGeneratorFactory::create($type);

    // Генерация карты сайта
    $generator->generate($pages, $filePath);

    echo 'Карта сайта успешно создана: ' . $filePath;
} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
