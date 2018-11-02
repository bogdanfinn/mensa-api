<?php

namespace App\Services;


use App\Dto\DayDto;
use App\Exceptions\CrawlException;
use App\Services\Crawler\MensaCrawlerInterface;
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

    public function crawlForUniversity($university): ?string
    {
        if (!array_key_exists(strtolower($university), $this->crawler)) {
            return null;
        }

        try {
            $websiteData = $this->crawler[strtolower($university)]->crawl();
        } catch (CrawlException $e) {
            //TODO: Errorhandling and logging
            return null;
        }

        return $this->serializer->serialize($websiteData, 'json');
    }

    private function normalizeWebsiteData(array $websiteData): array
    {
        $normalizedData = [];
        /** @var DayDto $dto */
        foreach ($websiteData as $dto) {
            $normalizedMeals = $this->normalizer->normalize($dto->getMeals());

            $normalizedDay = $this->normalizer->normalize($dto);
            $normalizedDay['meals'] = $normalizedMeals;
            $normalizedData[] = $normalizedDay;
        }

        return $normalizedData;
    }
}