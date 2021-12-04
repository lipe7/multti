<?php

namespace App\Traits;

trait FormatPhone
{
    public function phoneToInt($cel): string
    {
        return preg_replace("/[^0-9]/", "", $cel);
    }
}
