<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://opensource.org/licenses/MIT MIT License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\utils\arrays;

use kim\present\utils\arrays\ArrayBuilder as Builder;

/**
 * Utility class for quick access to ArrayBuilder.
 * Automatic static mapping of ArrayBuilder's methods.
 *
 * @link \kim\present\utils\arrays\ArrayBuilder
 *
 * @method static string join(array|\ArrayObject $origin, string $glue = "", string $prefix = "", string $suffix = "")
 * @method static bool validate(array|\ArrayObject $origin, callable $callable, bool $invertBreak = false)
 *
 *
 * @method static Builder slice(array|\ArrayObject $origin, int $offset, ?int $length = null, bool $preserveKeys = false)
 * @method static array sliceAs(array|\ArrayObject $origin, int $offset, ?int $length = null, bool $preserveKeys = false)
 *
 * @method static Builder map(array|\ArrayObject $origin, callable $callable)
 * @method static array mapAs(array|\ArrayObject $origin, callable $callable)
 *
 * @method static Builder filter(array|\ArrayObject $origin, callable $callable, int $flag = 0)
 * @method static array filterAs(array|\ArrayObject $origin, callable $callable, int $flag = 0)
 *
 * @method static Builder keys(array|\ArrayObject $origin)
 * @method static array keysAs(array|\ArrayObject $origin)
 *
 * @method static Builder values(array|\ArrayObject $origin)
 * @method static array valuesAs(array|\ArrayObject $origin)
 *
 * @method static Builder combine(array|\ArrayObject $origin)
 * @method static array combineAs(array|\ArrayObject $origin)
 *
 * @method static Builder merge(array|\ArrayObject $origin, $array)
 * @method static array mergeAs(array|\ArrayObject $origin, $array)
 *
 * @method static Builder mergeSoft(array|\ArrayObject $origin, $array)
 * @method static array mergeSoftAs(array|\ArrayObject $origin, $array)
 *
 * @method static Builder mapAssoc(array|\ArrayObject $origin, callable $callable)
 * @method static array mapAssocAs(array|\ArrayObject $origin, callable $callable)
 *
 * @method static Builder keyMap(array|\ArrayObject $origin, callable $callable)
 * @method static array keyMapAs(array|\ArrayObject $origin, callable $callable)
 *
 * @method static Builder flip(array|\ArrayObject $origin)
 * @method static array flipAs(array|\ArrayObject $origin)
 *
 * @method static Builder diff(array|\ArrayObject $origin, array|self $array)
 * @method static array diffAs(array|\ArrayObject $origin, array|self $array)
 *
 * @method static Builder diffKey(array|\ArrayObject $origin, array|self $array)
 * @method static array diffKeyAs(array|\ArrayObject $origin, array|self $array)
 *
 *
 * @method static mixed first(array|\ArrayObject $origin)
 * @method static mixed firstKey(array|\ArrayObject $origin)
 *
 * @method static mixed last(array|\ArrayObject $origin)
 * @method static mixed lastKey(array|\ArrayObject $origin)
 *
 * @method static mixed random(array|\ArrayObject $origin)
 * @method static mixed randomKey(array|\ArrayObject $origin)
 *
 *
 * @method static mixed pop(array|\ArrayObject $origin)
 * @method static mixed shift(array|\ArrayObject $origin)
 * @method static int|float sum(array|\ArrayObject $origin)
 *
 *
 * @method static array toArray(array|\ArrayObject $origin)
 * @method static string toString(array|\ArrayObject $origin)
 */
class ArrayUtils{
    /** @param array|\ArrayObject $origin */
    public static function from($origin) : Builder{
        return new Builder($origin);
    }

    /** @throws \BadMethodCallException */
    public static function __callStatic(string $name, array $arguments){
        return self::from(array_shift($arguments))->{$name}(...$arguments);
    }
}