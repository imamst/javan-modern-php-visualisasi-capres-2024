<?php

namespace App\Services;

use Carbon\Carbon;

class DateService
{
    public static function parseIndonesianDate($indonesianDate)
    {
        $monthTranslations = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        $indonesianDateParts = explode(' ', $indonesianDate);
        $day = (int)$indonesianDateParts[0];
        $month = $monthTranslations[$indonesianDateParts[1]];
        $year = (int)$indonesianDateParts[2];

        return Carbon::createFromDate($year, $month, $day);
    }
}
