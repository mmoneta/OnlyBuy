<?php

declare(strict_types=1);

namespace src\utils;

class DotEnv
{
    private const DOT_ENV_NAME = '.env';

    private static array $storage = [];

    private function __construct() {}

    public static function load(string $envDirectory): void
    {
        foreach (file($envDirectory . DIRECTORY_SEPARATOR . self::DOT_ENV_NAME) as $line) {
            [$key, $value] = explode('=', $line, 2);
            self::$storage[trim($key)] = trim($value);
        }
    }

    public static function get(string $key): ?string
    {
        if (!array_key_exists($key, self::$storage)) {
            return null;
        }

        return self::$storage[$key];
    }
}