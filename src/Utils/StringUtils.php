<?php

namespace App\Utils;

class StringUtils
{
    public static function getDateFromTableHeader($tableHeader): string
    {
        $dayStringParts = explode(',', $tableHeader);
        $date = $dayStringParts[1];

        return trim(str_replace(["\n", "\r"], '', $date)) . date("Y");
    }

    public static function getDayFromTableHeader($tableHeader): string
    {
        $dayStringParts = explode(',', $tableHeader);

        return $dayStringParts[0];
    }
}