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

use blugin\utils\arrays\ArrayBuilder as Builder;

/**
 * Utility class for quick access to ArrayBuilder.
 * Automatic static mapping of ArrayBuilder's methods.
 *
 * @link \blugin\utils\arrays\ArrayBuilder
 *
 * @method static bool validate(mixed[]|Builder $origin, callable $callable, bool $invertBreak = false)
 *
 * @method static mixed firstKey(mixed[]|Builder $origin)
 * @method static mixed lastKey(mixed[]|Builder $origin)
 * @method static mixed randomKey(mixed[]|Builder $origin)
 *
 * @method static mixed first(mixed[]|Builder $origin)
 * @method static mixed last(mixed[]|Builder $origin)
 * @method static mixed random(mixed[]|Builder $origin)
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
 * @method static Builder flip()
 * @method static array flipAs()
 *
 * @method static Builder diff(array|self $array)
 * @method static array diffAs(array|self $array)
 *
 * @method static Builder diffKey(array|self $array)
 * @method static array diffKeyAs(array|self $array)
 */
class ArrayUtil extends \ArrayObject{
    /** @param array|Builder $origin */
    public static function from($origin) : Builder{
        return new Builder($origin);
    }

    /** @throws \BadMethodCallException */
    public static function __callStatic(string $name, array $arguments){
        return self::from(array_shift($arguments))->{$name}(...$arguments);
    }
}