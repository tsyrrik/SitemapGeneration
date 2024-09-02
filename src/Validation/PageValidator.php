<?php

namespace App\Validation;

use App\Exceptions\InvalidDataException;

class PageValidator
{
    public static function validate(array $page): void
    {
        if (!isset($page['loc']) || !filter_var($page['loc'], FILTER_VALIDATE_URL)) {
            throw new InvalidDataException('Некорректный URL: ' . $page['loc']);
        }

        if (!isset($page['lastmod']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $page['lastmod'])) {
            throw new InvalidDataException('Некорректная дата: ' . $page['lastmod']);
        }

        if (!isset($page['priority']) || !is_numeric($page['priority']) || $page['priority'] < 0 || $page['priority'] > 1) {
            throw new InvalidDataException('Некорректный приоритет: ' . $page['priority']);
        }

        if (!isset($page['changefreq']) || !in_array($page['changefreq'], ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'], true)) {
            throw new InvalidDataException('Некорректная частота изменения: ' . $page['changefreq']);
        }
    }
}
