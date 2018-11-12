<?php

namespace App\Dto;

class MealDto
{
    /**
     * @var string
     */
    private $mealName = "";

    /**
     * @var string
     */
    private $price = "";

    /**
     * @var array
     */
    private $furtherInformation = [];

    /**
     * @return string
     */
    public function getMealName(): string
    {
        return $this->mealName;
    }

    /**
     * @param string $mealName
     */
    public function setMealName(string $mealName)
    {
        $this->mealName = $mealName;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price)
    {
        $this->price = $price;
    }

    /**
     * @return array
     */
    public function getFurtherInformation(): array
    {
        return $this->furtherInformation;
    }

    /**
     * @param array $furtherInformation
     */
    public function setFurtherInformation(array $furtherInformation): void
    {
        $this->furtherInformation = $furtherInformation;
    }
}