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
 * @method static string join(mixed[]|Builder $origin, string $glue = "", string $prefix = "", string $suffix = "")
 * @method static bool validate(mixed[]|Builder $origin, callable $callable, bool $invertBreak = false)
 *
 *
 * @method static Builder slice(mixed[]|Builder $origin, int $offset, ?int $length = null, bool $preserveKeys = false)
 * @method static array sliceAs(mixed[]|Builder $origin, int $offset, ?int $length = null, bool $preserveKeys = false)
 *
 * @method static Builder map(mixed[]|Builder $origin, callable $callable)
 * @method static array mapAs(mixed[]|Builder $origin, callable $callable)
 *
 * @method static Builder filter(mixed[]|Builder $origin, callable $callable, int $flag = 0)
 * @method static array filterAs(mixed[]|Builder $origin, callable $callable, int $flag = 0)
 *
 * @method static Builder keys(mixed[]|Builder $origin)
 * @method static array keysAs(mixed[]|Builder $origin)
 *
 * @method static Builder values(mixed[]|Builder $origin)
 * @method static array valuesAs(mixed[]|Builder $origin)
 *
 * @method static Builder combine(mixed[]|Builder $origin)
 * @method static array combineAs(mixed[]|Builder $origin)
 *
 * @method static Builder merge(mixed[]|Builder $origin, $array)
 * @method static array mergeAs(mixed[]|Builder $origin, $array)
 *
 * @method static Builder mergeSoft(mixed[]|Builder $origin, $array)
 * @method static array mergeSoftAs(mixed[]|Builder $origin, $array)
 *
 * @method static Builder mapAssoc(mixed[]|Builder $origin, callable $callable)
 * @method static array mapAssocAs(mixed[]|Builder $origin, callable $callable)
 *
 * @method static Builder keyMap(mixed[]|Builder $origin, callable $callable)
 * @method static array keyMapAs(mixed[]|Builder $origin, callable $callable)
 *
 * @method static Builder flip(mixed[]|Builder $origin)
 * @method static array flipAs(mixed[]|Builder $origin)
 *
 * @method static Builder diff(mixed[]|Builder $origin, array|self $array)
 * @method static array diffAs(mixed[]|Builder $origin, array|self $array)
 *
 * @method static Builder diffKey(mixed[]|Builder $origin, array|self $array)
 * @method static array diffKeyAs(mixed[]|Builder $origin, array|self $array)
 *
 *
 * @method static mixed first(mixed[]|Builder $origin)
 * @method static mixed firstKey(mixed[]|Builder $origin)
 *
 * @method static mixed last(mixed[]|Builder $origin)
 * @method static mixed lastKey(mixed[]|Builder $origin)
 *
 * @method static mixed random(mixed[]|Builder $origin)
 * @method static mixed randomKey(mixed[]|Builder $origin)
 *
 *
 * @method static mixed pop(mixed[]|Builder $origin)
 * @method static mixed shift(mixed[]|Builder $origin)
 * @method static int|float sum(mixed[]|Builder $origin)
 *
 *
 * @method static array toArray(mixed[]|Builder $origin)
 * @method static string toString(mixed[]|Builder $origin)
 */
class ArrayUtils extends \ArrayObject{
    /** @param array|Builder $origin */
    public static function from($origin) : Builder{
        return new Builder($origin);
    }

    /** @throws \BadMethodCallException */
    public static function __callStatic(string $name, array $arguments){
        return self::from(array_shift($arguments))->{$name}(...$arguments);
    }
}