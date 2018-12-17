<?php

namespace App\Services\Crawler;

use App\Exceptions\CrawlException;

interface MensaCrawlerInterface
{
    /**
     * @param String|null $timestamp
     * @throws CrawlException
     * @return array
     */
    public function crawl(?String $timestamp): array;
    public function getUniversityTag(): string;
}