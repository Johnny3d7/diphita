<?php

namespace App\Helpers;

use Carbon\Carbon;

class Functions
{
    public static function dateFromExcel($date){
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
    }
    
    public static function trimInsideString($numero, $position = 0){
        return $position < strlen($numero) ? trim(substr($numero,$position,2)).static::trimInsideString($numero, $position + 2) : trim(substr($numero,$position));
    }
}