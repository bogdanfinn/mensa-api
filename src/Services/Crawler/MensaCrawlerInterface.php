<?php

namespace App\Services\Crawler;


interface MensaCrawlerInterface
{
    public function crawl(): array;
    public function getUniversityTag(): string;
}