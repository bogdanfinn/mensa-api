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
}