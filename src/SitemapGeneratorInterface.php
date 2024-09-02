<?php

namespace App;

interface SitemapGeneratorInterface
{
    public function generate(array $pages, string $filePath): void;
}



