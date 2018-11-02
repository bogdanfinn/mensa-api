<?php

namespace App\Dto;

class DayDto
{
    /**
     * @var string
     */
    private $day = "";

    /**
     * @var string
     */
    private $date = "";

    /**
     * @var MealDto[]
     */
    private $meals = [];

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay(string $day)
    {
        $this->day = $day;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date)
    {
        $this->date = $date;
    }

    /**
     * @return MealDto[]
     */
    public function getMeals(): array
    {
        return $this->meals;
    }

    /**
     * @param MealDto[] $meals
     */
    public function setMeals(array $meals)
    {
        $this->meals = $meals;
    }

    /**
     * @param MealDto $mealDto
     */
    public function addMeal(MealDto $mealDto): void
    {
        $this->meals[] = $mealDto;
    }
}