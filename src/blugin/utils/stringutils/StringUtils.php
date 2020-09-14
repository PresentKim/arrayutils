<?php

/*
 *
 *  ____  _             _         _____
 * | __ )| |_   _  __ _(_)_ __   |_   _|__  __ _ _ __ ___
 * |  _ \| | | | |/ _` | | '_ \    | |/ _ \/ _` | '_ ` _ \
 * | |_) | | |_| | (_| | | | | |   | |  __/ (_| | | | | | |
 * |____/|_|\__,_|\__, |_|_| |_|   |_|\___|\__,_|_| |_| |_|
 *                |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License.
 *
 * @author  Blugin team
 * @link    https://github.com/Blugin
 * @license https://www.gnu.org/licenses/mit MIT License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace blugin\utils\stringutils;

class StringUtils{
    private function __construct(){
    }

    public static function stripSpace(string $string) : string{
        return preg_replace('/\s+/', '', $string);
    }

    public static function startsWith(string $haystack, string $needle) : bool{
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    public static function endsWith(string $haystack, string $needle) : bool{
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    public static function contains(string $haystack, string $needle) : bool{
        return $needle === "" || strpos($haystack, $needle) !== false;
    }
}