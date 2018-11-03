<?php

namespace App\Services\Crawler;

use App\Dto\DayDto;
use App\Dto\MealDto;
use App\Exceptions\CrawlException;
use App\Utils\StringUtils;
use Symfony\Component\DomCrawler\Crawler;

class NordakademieMensaCrawler extends AbstractMensaCrawler
{
    const NORDAKADEMIE_MENSA_URL = 'https://cis.nordakademie.de/mensa/speiseplan.cmd';
    const UNIVERSITY_TAG = 'NAK';

    public function __construct()
    {
        parent::__construct();
    }

    public function getUniversityTag(): string
    {
        return self::UNIVERSITY_TAG;
    }

    public function crawl(): array
    {
        $htmlContent = $this->loadHtmlContent();

        if (!$htmlContent) {
            throw new CrawlException();
        }

        $parsedWebsiteContent = $this->crawlWebsiteContent($htmlContent);

        $nextMondayTimestamp = strtotime("next monday") * 1000;
        $htmlContent = $this->loadHtmlContent($nextMondayTimestamp);

        if (!$htmlContent) {
            throw new CrawlException();
        }

        $parsedWebsiteContentForNextWeek = $this->crawlWebsiteContent($htmlContent);

        return array_merge($parsedWebsiteContent, $parsedWebsiteContentForNextWeek);
    }

    private function loadHtmlContent(int $timestamp = null): ?string
    {
        $url = self::NORDAKADEMIE_MENSA_URL;

        if ($timestamp) {
            $url = self::NORDAKADEMIE_MENSA_URL . '?date=' . $timestamp;
        }

        try {
            return file_get_contents($url);
        } catch (\Exception $e) {
            //TODO: Implement logging
            return null;
        }
    }

    private function parseWebsiteContent(array $tableHeaders, array $tableContent): array
    {
        /** @var DayDto[] $mealEntries */
        $mealEntries = [];

        foreach ($tableHeaders as $tableHeader) {
            $dayDto = new DayDto();
            $dayDto->setDay(StringUtils::getDayFromTableHeader($tableHeader));
            $dayDto->setDate(StringUtils::getDateFromTableHeader($tableHeader));

            $mealEntries[] = $dayDto;
        }

        foreach ($tableContent as $index => $tableContentEntry) {
            foreach ($tableContentEntry as $meal) {
                $dayEntry = $mealEntries[$index];
                $mealDto = new MealDto();
                $mealDto->setMealName($meal['name']);
                $mealDto->setPrice($meal['price']);
                $dayEntry->addMeal($mealDto);
            }
        }

        return $mealEntries;
    }

    private function crawlWebsiteContent(string $htmlContent): array
    {
        $this->domCrawler->clear();
        $this->domCrawler->addHTMLContent($htmlContent);

        $tableHeaders = $this->domCrawler->filter('.speiseplan-head')->filter('td')->each(function (Crawler $td) {
            return trim($td->text());
        });

        $tableContent = $this->domCrawler->filter('.speiseplan-tag-container')->each(function (Crawler $meals) {
            return $meals->filter('.gericht')->each(function (Crawler $td) {
                $mealName = $td->filter('.speiseplan-kurzbeschreibung')->each(function (Crawler $meal) {
                    return trim(preg_replace('/\(.*\)/U', '', $meal->text()));
                });
                $price = $td->filter('.speiseplan-preis')->each(function (Crawler $price) {
                    return trim(str_replace("Eur", "", $price->text()));
                });

                return ['name' => $mealName[0], 'price' => $price[0]];
            });
        });

        return $this->parseWebsiteContent($tableHeaders, $tableContent);
    }
}