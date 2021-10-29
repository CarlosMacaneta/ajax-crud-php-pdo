<?php

namespace App\Common;

class Environment
{
    public static function load($dir)
    {
        if (!file_exists($dir.'/.env')) {
            return false;
        }

        $lines = file($dir.'/.env');
        $lines = array_map('trim', $lines);
        
        foreach ($lines as $line) {
            if (!empty($line)) putenv($line);                      
        }
    }
} 