<?php

namespace App\Services\Console;

class CreateGoodCharacteristicsCommandService
{
    public function convertPrefixToModelName(string $prefix): string
    {
        $explodedPrefix = explode('_', $prefix);
        $result = '';

        foreach ($explodedPrefix as $item) {
            $result .= ucfirst($item);
        }

        return 'Good' . $result;
    }
}
