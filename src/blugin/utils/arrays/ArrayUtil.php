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

namespace blugin\utils\arrays;

class ArrayUtil extends \ArrayObject{
    /** @param array|ArrayBuilder $origin */
    public static function from($origin) : ArrayBuilder{
        return new ArrayBuilder($origin);
    }

    /** @param array|ArrayBuilder $origin */
    public static function join($origin, string $glue = "", string $prefix = "", string $suffix = "") : string{
        return self::from($origin)->join($glue, $prefix, $suffix);
    }

    /** @param array|ArrayBuilder $origin */
    public static function validate($origin, callable $callable, bool $invertBreak = false) : bool{
        return self::from($origin)->validate($callable, $invertBreak);
    }

    /** @param array|ArrayBuilder $origin */
    public static function slice($origin, int $offset, ?int $length = null, bool $preserveKeys = false) : ArrayBuilder{
        return self::from($origin)->slice($offset, $length, $preserveKeys);
    }

    /** @param array|ArrayBuilder $origin */
    public static function sliceAs($origin, int $offset, ?int $length = null, bool $preserveKeys = false) : array{
        return self::from($origin)->sliceAs($offset, $length, $preserveKeys);
    }

    /** @param array|ArrayBuilder $origin */
    public static function map($origin, callable $callable) : ArrayBuilder{
        return self::from($origin)->map($callable);
    }

    /** @param array|ArrayBuilder $origin */
    public static function mapAs($origin, callable $callable) : array{
        return self::from($origin)->mapAs($callable);
    }

    /** @param array|ArrayBuilder $origin */
    public static function filter($origin, callable $callable, int $flag = 0) : ArrayBuilder{
        return self::from($origin)->filter($callable, $flag);
    }

    /** @param array|ArrayBuilder $origin */
    public static function filterAs($origin, callable $callable, int $flag = 0) : array{
        return self::from($origin)->filterAs($callable, $flag);
    }

    /** @param array|ArrayBuilder $origin */
    public static function keys($origin) : ArrayBuilder{
        return self::from($origin)->keys();
    }

    /** @param array|ArrayBuilder $origin */
    public static function keysAs($origin) : array{
        return self::from($origin)->keysAs();
    }

    /** @param array|ArrayBuilder $origin */
    public static function values($origin) : ArrayBuilder{
        return self::from($origin)->values();
    }

    /** @param array|ArrayBuilder $origin */
    public static function valuesAs($origin) : array{
        return self::from($origin)->valuesAs();
    }

    /** @param array|ArrayBuilder $origin */
    public static function combine($origin) : ArrayBuilder{
        return self::from($origin)->combine();
    }

    /** @param array|ArrayBuilder $origin */
    public static function combineAs($origin) : array{
        return self::from($origin)->combineAs();
    }

    /**
     * @param array|ArrayBuilder $origin
     * @param array|ArrayBuilder $array
     */
    public static function merge($origin, $array) : ArrayBuilder{
        return self::from($origin)->merge($array);
    }

    /**
     * @param array|ArrayBuilder $origin
     * @param array|ArrayBuilder $array
     */
    public static function mergeAs($origin, $array) : array{
        return self::from($origin)->mergeAs($array);
    }

    /**
     * @param array|ArrayBuilder $origin
     * @param array|ArrayBuilder $array
     */
    public static function mergeSoft($origin, $array) : ArrayBuilder{
        return self::from($origin)->mergeSoft($array);
    }

    /**
     * @param array|ArrayBuilder $origin
     * @param array|ArrayBuilder $array
     */
    public static function mergeSoftAs($origin, $array) : array{
        return self::from($origin)->mergeSoftAs($array);
    }

    /** @param array|ArrayBuilder $origin */
    public static function mapAssoc($origin, callable $callable) : ArrayBuilder{
        return self::from($origin)->mapAssoc($callable);
    }

    /** @param array|ArrayBuilder $origin */
    public static function mapAssocAs($origin, callable $callable) : array{
        return self::from($origin)->mapAssocAs($callable);
    }

    /** @param array|ArrayBuilder $origin */
    public static function keyMap($origin, callable $callable) : ArrayBuilder{
        return self::from($origin)->keyMap($callable);
    }

    /** @param array|ArrayBuilder $origin */
    public static function keyMapAs($origin, callable $callable) : array{
        return self::from($origin)->keyMapAs($callable);
    }
}