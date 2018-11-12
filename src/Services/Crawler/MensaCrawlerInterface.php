<?php

namespace App\Services\Crawler;


use App\Exceptions\CrawlException;

interface MensaCrawlerInterface
{
    /**
     * @throws CrawlException
     * @return array
     */
    public function crawl(): array;
    public function getUniversityTag(): string;
}