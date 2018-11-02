<?php

namespace App\Services\Crawler;

use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractMensaCrawler implements MensaCrawlerInterface
{
    protected $domCrawler;

    public function __construct()
    {
        $this->domCrawler = new Crawler();
    }

    public abstract function getUniversityTag(): string;
}