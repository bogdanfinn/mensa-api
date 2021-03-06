<?php

namespace App\Services;

use App\Exceptions\CrawlException;
use App\Services\Crawler\MensaCrawlerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MensaCrawlerService
{
    /**
     * @var MensaCrawlerInterface[]
     */
    private $crawler = [];

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function addCrawler(MensaCrawlerInterface $crawler): void
    {
        $this->crawler[strtolower($crawler->getUniversityTag())] = $crawler;
    }

    public function crawlForUniversity(String $university, ?String $timestamp = null): ?string
    {
        if (!array_key_exists(strtolower($university), $this->crawler)) {
            return null;
        }

        $crawler = $this->crawler[strtolower($university)];

        try {
            $websiteData = $crawler->crawl($timestamp);
        } catch (CrawlException $e) {
            //TODO: Errorhandling and logging
            return null;
        }


        return $this->serializer->serialize($websiteData, 'json');
    }
}