<?php

namespace App\Traits;

trait DateFunctions
{
    public function getFormattedDate($date, $inputFormat = 'd/m/y', $outputFormat = 'Y-m-d')
    {

        $new_date = \DateTime::createFromFormat($inputFormat, $date);

        return $new_date->format($outputFormat);
    }

    public function checkValidDate($date, $inputFormat = 'Y-m-d')
    {

        if (! $date) {
            return false;
        }

        $new_date = \DateTime::createFromFormat($inputFormat, $date);
        if (checkdate($new_date->format('m'), $new_date->format('d'), $new_date->format('Y'))) {
            return true;
        } else {
            return false;
        }
    }
}
