<?php

namespace App\Helpers;

use \NumberFormatter;

class MoneyFormat
{

    public function money($sum)
    {
        $fmt = new NumberFormatter( 'ru_RU', NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($sum, "RUB")."\n";
    }

}
