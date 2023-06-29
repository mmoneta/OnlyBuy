<?php
class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function (string $class): bool {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';

            if (file_exists($file)) {
                require_once $file;
                return true;
            }

            return false;
        });
    }
}

Autoloader::register();