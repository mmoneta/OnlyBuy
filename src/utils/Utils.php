<?php

namespace src\utils;

class Utils
{
    public static function dashesToCamelCase($string, $capitalizeFirstCharacter = false): string
    {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
    
        return $str;
    }
}
