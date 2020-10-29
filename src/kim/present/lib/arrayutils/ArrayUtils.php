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

namespace kim\present\lib\arrayutils;

use ArrayObject;

/**
 * Class ArrayUtils is provides a method to fancy manipulate an array
 *
 * Declare methods that implements internal array functions,
 * And methods that implements javascript array methods
 *
 * @link https://www.php.net/manual/en/ref.array.php
 * @link https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array
 *
 * ===================================
 *
 * @method        ArrayUtils chunk(int $size, bool $preserveKeys = false)
 * @method        array      chunkAs(int $size, bool $preserveKeys = false)
 * @method static ArrayUtils chunkFrom(iterable $from, int $size, bool $preserveKeys = false)
 * @method static array      chunkFromAs(iterable $from, int $size, bool $preserveKeys = false)
 *
 * @method        ArrayUtils column(mixed $valueKey, mixed $indexKey = null)
 * @method        array      columnAs(mixed $valueKey, mixed $indexKey = null)
 * @method static ArrayUtils columnFrom(iterable $from, mixed $valueKey, mixed $indexKey = null)
 * @method static array      columnFromAs(iterable $from, mixed $valueKey, mixed $indexKey = null)
 *
 * @method        ArrayUtils combine(iterable|null $valueArray = null)
 * @method        array      combineAs(iterable|null $valueArray = null)
 * @method static ArrayUtils combineFrom(iterable $from, iterable|null $valueArray = null)
 * @method static array      combineFromAs(iterable $from, iterable|null $valueArray = null)
 *
 * @method        ArrayUtils concat(mixed ...$values)
 * @method        array      concatAs(mixed ...$values)
 * @method static ArrayUtils concatFrom(mixed ...$values)
 * @method static array      concatFromAs(mixed ...$values)
 *
 * @method        ArrayUtils concatSoft(mixed ...$values)
 * @method        array      concatSoftAs(mixed ...$values)
 * @method static ArrayUtils concatSoftFrom(mixed ...$values)
 * @method static array      concatSoftFromAs(mixed ...$values)
 *
 * @method        ArrayUtils countValues()
 * @method        array      countValuesAs()
 * @method static ArrayUtils countValuesFrom(iterable $from)
 * @method static array      countValuesFromAs(iterable $from)
 *
 * @method        ArrayUtils diff(iterable ...$iterables)
 * @method        array      diffAs(iterable ...$iterables)
 * @method static ArrayUtils diffFrom(iterable $from, iterable ...$iterables)
 * @method static array      diffFromAs(iterable $from, iterable ...$iterables)
 *
 * @method        ArrayUtils diffAssoc(iterable ...$iterables)
 * @method        array      diffAssocAs(iterable ...$iterables)
 * @method static ArrayUtils diffAssocFrom(iterable $from, iterable ...$iterables)
 * @method static array      diffAssocFromAs(iterable $from, iterable ...$iterables)
 *
 * @method        ArrayUtils diffKey(iterable ...$iterables)
 * @method        array      diffKeyAs(iterable ...$iterables)
 * @method static ArrayUtils diffKeyFrom(iterable $from, iterable ...$iterables)
 * @method static array      diffKeyFromAs(iterable $from, iterable ...$iterables)
 *
 * @method        ArrayUtils fill(mixed $value, int $start = 0, int $end = null)
 * @method        array      fillAs(mixed $value, int $start = 0, int $end = null)
 * @method static ArrayUtils fillFrom(iterable $from, mixed $value, int $start = 0, int $end = null)
 * @method static array      fillFromAs(iterable $from, mixed $value, int $start = 0, int $end = null)
 *
 * @method        ArrayUtils fillKeys(mixed $value)
 * @method        array      fillKeysAs(mixed $value)
 * @method static ArrayUtils fillKeysFrom(iterable $from, mixed $value)
 * @method static array      fillKeysFromAs(iterable $from, mixed $value)
 *
 * @method        ArrayUtils filter(callable $callback)
 * @method        array      filterAs(callable $callback)
 * @method static ArrayUtils filterFrom(iterable $from, callable $callback)
 * @method static array      filterFromAs(iterable $from, callable $callback)
 *
 * @method        ArrayUtils flat(int $dept = 1)
 * @method        array      flatAs(int $dept = 1)
 * @method static ArrayUtils flatFrom(iterable $from, int $dept = 1)
 * @method static array      flatFromAs(iterable $from, int $dept = 1)
 *
 * @method        ArrayUtils flatMap(callable $callback)
 * @method        array      flatMapAs(callable $callback)
 * @method static ArrayUtils flatMapFrom(iterable $from, callable $callback)
 * @method static array      flatMapFromAs(iterable $from, callable $callback)
 *
 * @method        ArrayUtils flip()
 * @method        array      flipAs()
 * @method static ArrayUtils flipFrom(iterable $from)
 * @method static array      flipFromAs(iterable $from)
 *
 * @method        ArrayUtils forEach(callable $callback)
 * @method        array      forEachAs(callable $callback)
 * @method static ArrayUtils forEachFrom(iterable $from, callable $callback)
 * @method static array      forEachFromAs(iterable $from, callable $callback)
 *
 * @method        ArrayUtils intersect(iterable ...$iterables)
 * @method        array      intersectAs(iterable ...$iterables)
 * @method static ArrayUtils intersectFrom(iterable $from, iterable ...$iterables)
 * @method static array      intersectFromAs(iterable $from, iterable ...$iterables)
 *
 * @method        ArrayUtils intersectAssoc(iterable ...$iterables)
 * @method        array      intersectAssocAs(iterable ...$iterables)
 * @method static ArrayUtils intersectAssocFrom(iterable $from, iterable ...$iterables)
 * @method static array      intersectAssocFromAs(iterable $from, iterable ...$iterables)
 *
 * @method        ArrayUtils intersectkey(iterable ...$iterables)
 * @method        array      intersectkeyAs(iterable ...$iterables)
 * @method static ArrayUtils intersectkeyFrom(iterable $from, iterable ...$iterables)
 * @method static array      intersectkeyFromAs(iterable $from, iterable ...$iterables)
 *
 * @method        ArrayUtils keys()
 * @method        array      keysAs()
 * @method static ArrayUtils keysFrom(iterable $from)
 * @method static array      keysFromAs(iterable $from)
 *
 * @method        ArrayUtils map(callable $callback)
 * @method        array      mapAs(callable $callback)
 * @method static ArrayUtils mapFrom(iterable $from, callable $callback)
 * @method static array      mapFromAs(iterable $from, callable $callback)
 *
 * @method        ArrayUtils mapAssoc(callable $callback)
 * @method        array      mapAssocAs(callable $callback)
 * @method static ArrayUtils mapAssocFrom(iterable $from, callable $callback)
 * @method static array      mapAssocFromAs(iterable $from, callable $callback)
 *
 * @method        ArrayUtils mapKey(callable $callback)
 * @method        array      mapKeyAs(callable $callback)
 * @method static ArrayUtils mapKeyFrom(iterable $from, callable $callback)
 * @method static array      mapKeyFromAs(iterable $from, callable $callback)
 *
 * @method        ArrayUtils merge(mixed ...$iterables)
 * @method        array      mergeAs(mixed ...$iterables)
 * @method static ArrayUtils mergeFrom(mixed ...$iterables)
 * @method static array      mergeFromAs(mixed ...$iterables)
 *
 * @method        ArrayUtils mergeSoft(mixed ...$iterables)
 * @method        array      mergeSoftAs(mixed ...$iterables)
 * @method static ArrayUtils mergeSoftFrom(iterable $from, mixed ...$iterables)
 * @method static array      mergeSoftFromAs(iterable $from, mixed ...$iterables)
 *
 * @method        ArrayUtils pad(int $size, mixed $value)
 * @method        array      padAs(int $size, mixed $value)
 * @method static ArrayUtils padFrom(iterable $from, int $size, mixed $value)
 * @method static array      padFromAs(iterable $from, int $size, mixed $value)
 *
 * @method        ArrayUtils push(mixed ...$values)
 * @method        array      pushAs(mixed ...$values)
 * @method static ArrayUtils pushFrom(iterable $from, mixed ...$values)
 * @method static array      pushFromAs(iterable $from, mixed ...$values)
 *
 * @method        ArrayUtils replace(iterable ...$iterables)
 * @method        array      replaceAs(iterable ...$iterables)
 * @method static ArrayUtils replaceFrom(iterable $from, iterable ...$iterables)
 * @method static array      replaceFromAs(iterable $from, iterable ...$iterables)
 *
 * @method        ArrayUtils reverse(bool $preserveKeys = false)
 * @method        array      reverseAs(bool $preserveKeys = false)
 * @method static ArrayUtils reverseFrom(iterable $from, bool $preserveKeys = false)
 * @method static array      reverseFromAs(iterable $from, bool $preserveKeys = false)
 *
 * @method        ArrayUtils slice(int $start = 0, int $end = null, bool $preserveKeys = false)
 * @method        array      sliceAs(int $start = 0, int $end = null, bool $preserveKeys = false)
 * @method static ArrayUtils sliceFrom(iterable $from, int $start = 0, int $end = null, bool $preserveKeys = false)
 * @method static array      sliceFromAs(iterable $from, int $start = 0, int $end = null, bool $preserveKeys = false)
 *
 * @method        ArrayUtils sort(?callable $callback = null)
 * @method        array      sortAs(?callable $callback = null)
 * @method static ArrayUtils sortFrom(iterable $from, ?callable $callback = null)
 * @method static array      sortFromAs(iterable $from, ?callable $callback = null)
 *
 * @method        ArrayUtils sortKey(?callable $callback = null)
 * @method        array      sortKeyAs(?callable $callback = null)
 * @method static ArrayUtils sortKeyFrom(iterable $from, ?callable $callback = null)
 * @method static array      sortKeyFromAs(iterable $from, ?callable $callback = null)
 *
 * @method        ArrayUtils unique(int $sortFlags = SORT_STRING)
 * @method        array      uniqueAs(int $sortFlags = SORT_STRING)
 * @method static ArrayUtils uniqueFrom(iterable $from, int $sortFlags = SORT_STRING)
 * @method static array      uniqueFromAs(iterable $from, int $sortFlags = SORT_STRING)
 *
 * @method        ArrayUtils unshift(mixed ...$values)
 * @method        array      unshiftAs(mixed ...$values)
 * @method static ArrayUtils unshiftFrom(iterable $from, mixed ...$values)
 * @method static array      unshiftFromAs(iterable $from, mixed ...$values)
 *
 * @method        ArrayUtils values()
 * @method        array      valuesAs()
 * @method static ArrayUtils valuesFrom(iterable $from)
 * @method static array      valuesFromAs(iterable $from)
 *
 * @method        bool       every(callable $callback)
 * @method static bool       everyFrom(iterable $from, callable $callback)
 *
 * @method        bool       includes(mixed $needle, int $start = 0)
 * @method static bool       includesFrom(iterable $from, mixed $needle, int $start = 0)
 *
 * @method        bool       keyExists(int|string $key)
 * @method static bool       keyExistsFrom(iterable $from, int|string $key)
 *
 * @method        bool       some(callable $callback)
 * @method static bool       someFrom(iterable $from, callable $callback)
 *
 * @method        int|float  sum()
 * @method static int|float  sumFrom(iterable $from)
 *
 * @method        mixed      find(callable $callback)
 * @method static mixed      findFrom(iterable $from, callable $callback)
 *
 * @method        int|string|null findIndex(callable $callback)
 * @method static int|string|null findIndexFrom(iterable $from, callable $callback)
 *
 * @method        mixed      first()
 * @method static mixed      firstFrom(iterable $from)
 *
 * @method        int|string|null indexOf(mixed $needle, int $start = 0)
 * @method static int|string|null indexOfFrom(iterable $from, mixed $needle, int $start = 0)
 *
 * @method        int|string|null keyFirst()
 * @method static int|string|null keyFirstFrom(iterable $from)
 *
 * @method        int|string|null keyLast()
 * @method static int|string|null keyLastFrom(iterable $from)
 *
 * @method        int|string|null keyRandom()
 * @method static int|string|null keyRandomFrom(iterable $from)
 *
 * @method        mixed      last()
 * @method static mixed      lastFrom(iterable $from)
 *
 * @method        mixed      pop()
 * @method static mixed      popFrom(iterable &$from)
 *
 * @method        mixed      random()
 * @method static mixed      randomFrom(iterable $from)
 *
 * @method        mixed      reduce(callable $callback, mixed $initialValue = null)
 * @method static mixed      reduceFrom(iterable $from, callable $callback, mixed $initialValue = null)
 *
 * @method        mixed      reduceRight(callable $callback, mixed $initialValue = null)
 * @method static mixed      reduceRightFrom(iterable $from, callable $callback, mixed $initialValue = null)
 *
 * @method        mixed      search(mixed $needle, int $start = 0)
 * @method static mixed      searchFrom(iterable $from, mixed $needle, int $start = 0)
 *
 * @method        mixed      shift()
 * @method static mixed      shiftFrom(iterable &$from)
 *
 * @method        array      splice(int $offset, ?int $length = null, mixed ...$replacement)
 * @method static array      spliceFrom(iterable $from, int $offset, ?int $length = null, mixed ...$replacement)
 *
 * @method        string     join(string $glue = ",", string $prefix = "", string $suffix = "")
 * @method static string     joinFrom(iterable $from, string $glue = ",", string $prefix = "", string $suffix = "")
 */
class ArrayUtils extends ArrayObject{
    /** Creates a new, shallow-copied ArrayUtils instance from an iterable */
    public function __construct(iterable $iterable, int $flags = 0, string $iteratorClass = "ArrayIterator"){
        parent::__construct((array) $iterable, $flags, $iteratorClass);
    }

    /**
     * Creates a new, shallow-copied ArrayUtils instance from an iterable
     *
     * @param mixed ...$elements
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/from
     */
    public static function from(iterable $iterable, ?callable $mapFn = null) : ArrayUtils{
        $instance = new self($iterable);
        if($mapFn !== null){
            $instance = $instance->map($mapFn);
        }
        return $instance;
    }

    /**
     * Creates a new, ArrayUtils instance from variadic function arguments
     *
     * @param mixed ...$elements
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/of
     */
    public static function of(...$elements) : ArrayUtils{
        return new self($elements);
    }

    /** Cast all elements of the iterable to an array */
    public static function mapToArray(iterable $iterables) : array{
        return self::__map((array) $iterables, function($iterable){ return (array) $iterable; });
    }

    /** Exchange the array for another one */
    public function exchange(array $array) : ArrayUtils{
        $this->exchangeArray($array);
        return $this;
    }

    /**
     * Split an array into chunks
     *
     * @see \array_chunk
     * @url https://www.php.net/manual/en/function.array-chunk.php
     */
    protected static function __chunk(array $from, int $size, bool $preserveKeys = false) : array{
        return array_chunk($from, $size, $preserveKeys);
    }

    /**
     * Returns the values from a single column in the input array
     *
     * @param mixed $valueKey
     * @param mixed $indexKey = null
     *
     * @see \array_column
     * @url https://www.php.net/manual/en/function.array-column.php
     */
    protected static function __column(array $from, $valueKey, $indexKey = null) : array{
        return array_column($from, $valueKey, $indexKey);
    }

    /**
     * Creates an array by using one array for keys and another for its values
     *
     * @param array|null $valueArray If is null, Use self clone
     *
     * @see \array_combine
     * @url https://www.php.net/manual/en/function.array-column.php
     */
    protected static function __combine(array $from, ?iterable $valueArray = null) : array{
        return array_combine($from, (array) ($valueArray ?? $from));
    }

    /**
     * Merge one or more arrays
     *
     * @params mixed ...$value
     *
     * @see \array_merge
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/concat
     */
    protected static function __concat(...$values) : array{
        return array_merge(...self::mapToArray($values));
    }

    /**
     * All similar to @see __concat(), but not overwrite existing keys
     *
     * @params mixed ...$value
     */
    protected static function __concatSoft(...$values) : array{
        $array = [];
        foreach($values as $value){
            $array += (array) $value;
        }
        return $array;
    }

    /**
     * Counts all the values of an array
     *
     * @see \array_count_values
     * @url https://www.php.net/manual/en/function.array-count-values.php
     */
    protected static function __countValues(array $from) : array{
        return array_count_values($from);
    }

    /**
     * Computes the difference of arrays
     *
     * @see \array_diff
     * @url https://www.php.net/manual/en/function.array-diff.php
     */
    protected static function __diff(array $from, iterable ...$iterables) : array{
        return array_diff($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see __diff(), but this applies with additional index check
     *
     * @see \array_diff_assoc
     * @url https://www.php.net/manual/en/function.array-diff-assoc.php
     */
    protected static function __diffAssoc(array $from, iterable ...$iterables) : array{
        return array_diff_assoc($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see __diff(), but this applies to keys
     *
     * @see \array_diff_key
     * @url https://www.php.net/manual/en/function.array-diff-key.php
     */
    protected static function __diffKey(array $from, iterable ...$iterables) : array{
        return array_diff_key($from, ...self::mapToArray($iterables));
    }

    /**
     * Tests whether all elements pass the $callback function
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/every
     */
    protected static function _every(array $from, callable $callback) : bool{
        foreach($from as $key => $value){
            if(!$callback($value, $key, $from))
                return false;
        }
        return true;
    }

    /**
     * Changes all elements in an array to a provided value, from a start index to an end index
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/fill
     */
    protected static function __fill(array $from, $value, int $start = 0, int $end = null) : array{
        $count = count($from);
        $end = $end ?? $count;

        $i = $start < 0 ? max($count + $start, 0) : min($start, $count);
        $max = $end < 0 ? max($count + $end, 0) : min($end, $count);
        for(; $i < $max; ++$i){
            $from[$i] = $value;
        }

        return $from;
    }

    /**
     * Fill an array with values, specifying keys
     *
     * @param mixed $value
     *
     * @see \array_fill_keys
     * @url https://www.php.net/manual/en/function.array-fill-keys.php
     */
    protected static function __fillKeys(array $from, $value) : array{
        return array_fill_keys($from, $value);
    }

    /**
     * Returns a new array with all elements that pass the $callback function
     *
     * @see \array_filter
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter
     */
    protected static function __filter(array $from, callable $callback) : array{
        $array = [];
        foreach($from as $key => $value){
            if($callback($value, $key, $from))
                $array[$key] = $value;
        }
        return $array;
    }

    /**
     * Returns the value of the first element that that pass the $callback function
     *
     * @return mixed;
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/find
     */
    protected static function _find(array $from, callable $callback){
        foreach($from as $key => $value){
            if($callback($value, $key, $from))
                return $value;
        }
        return null;
    }

    /**
     * Returns the key of the first element that that pass the $callback function
     *
     * @return int|string|null
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/findIndex
     */
    protected static function _findIndex(array $from, callable $callback){
        foreach($from as $key => $value){
            if($callback($value, $key, $from))
                return $key;
        }
        return null;
    }

    /**
     * Returns the value at the result of _keyFirst()
     *
     * @return mixed
     *
     * @see _keyFirst()
     */
    protected static function _first(array $from){
        return $from[self::_keyFirst($from)];
    }

    /**
     * Returns a new array with all sub-array elements concatenated into it recursively up to the specified depth
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/flat
     */
    protected static function __flat(array $from, int $dept = 1) : array{
        if($dept === 0) return (array) $from;
        return self::_reduce($from,
            function($currentValue, $value) use ($dept){
                return self::__concat(
                    $currentValue,
                    is_array($value) ? self::__flat($value, $dept - 1) : $value
                );
            }, []);
    }

    /**
     * Returns a new array formed by applying $callback function and then flattening the result by one level
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/flatMap
     */
    protected static function __flatMap(array $from, callable $callback) : array{
        return self::__concat(...self::__map($from, $callback));
    }

    /**
     * Exchanges all keys with their associated values in an array
     *
     * @see \array_flip
     * @url https://www.php.net/manual/en/function.array-flip.php
     */
    protected static function __flip(array $from) : array{
        return array_flip($from);
    }

    /**
     * Executes a $callback function once for each array element.
     *
     * @see foreach
     * @url https://www.php.net/manual/en/function.array-map.php
     */
    protected static function __forEach(array $from, callable $callback) : array{
        foreach($from as $key => $value){
            $callback($value, $key, $from);
        }
        return $from;
    }

    /**
     * Tests whether an array includes a $needle
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/includes
     */
    protected static function _includes(array $from, $needle, int $start = 0) : bool{
        $values = array_values($from);
        $count = count($from);
        $i = $start < 0 ? max($count + $start, 0) : min($start, $count);
        for(; $i < $count; ++$i){
            if($needle === $values[$i])
                return true;
        }

        return false;
    }

    /**
     * Returns the first index at which a given element can be found in the array
     *
     * @return int|string|null
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf
     */
    protected static function _indexOf(array $from, $needle, int $start = 0){
        $keys = array_keys($from);
        $values = array_values($from);
        $count = count($from);
        $i = $start < 0 ? max($count + $start, 0) : min($start, $count);
        for(; $i < $count; ++$i){
            if($needle === $values[$i])
                return $keys[$i];
        }

        return null;
    }

    /**
     * Computes the intersection of arrays
     *
     * @see \array_intersect
     * @url https://www.php.net/manual/en/function.array-intersect.php
     */
    protected static function __intersect(array $from, iterable ...$iterables) : array{
        return array_intersect($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see __intersect(), but this applies to both keys and values
     *
     * @see \array_intersect_assoc
     * @url https://www.php.net/manual/en/function.array-intersect-assoc.php
     */
    protected static function __intersectAssoc(array $from, iterable ...$iterables) : array{
        return array_intersect_assoc($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see __intersect(), but this applies to keys
     *
     * @see \array_intersect_key
     * @url https://www.php.net/manual/en/function.array-intersect-key.php
     */
    protected static function __intersectkey(array $from, iterable ...$iterables) : array{
        return array_intersect_key($from, ...self::mapToArray($iterables));
    }

    /**
     * Join array elements with a string. You can specify a suffix and prefix
     *
     * @see \implode
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/join
     */
    protected static function _join(array $from, string $glue = ",", string $prefix = "", string $suffix = "") : string{
        return $prefix . implode($glue, $from) . $suffix;
    }

    /** Alias of @see offsetExists() */
    protected static function _keyExists(array $from, $key) : bool{
        return isset($from[$key]);
    }

    /**
     * Gets the first key of an array
     *
     * @return int|string|null
     *
     * @see \array_key_first
     * @url https://www.php.net/manual/en/function.array-key-first.php
     */
    protected static function _keyFirst(array $from){
        return array_keys($from)[0] ?? null;
    }

    /**
     * Gets the last key of an array
     *
     * @return int|string|null
     *
     * @see \array_key_last
     * @url https://www.php.net/manual/en/function.array-key-last.php
     */
    protected static function _keyLast(array $from){
        return array_keys($from)[count($from) - 1] ?? null;
    }

    /**
     * Gets the random key of an array
     *
     * @return int|string|null
     *
     * @see \array_rand
     * @url https://www.php.net/manual/en/function.array-rand.php
     */
    protected static function _keyRandom(array $from){
        return ($keys = array_keys($from))[rand(0, count($keys) - 1)] ?? null;
    }

    /**
     * Returns all the keys of an array
     *
     * @see \array_keys
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/keys
     */
    protected static function __keys(array $from) : array{
        return array_keys($from);
    }

    /** Returns the value at the result of @see _keyLast() */
    protected static function _last(array $from){
        return $from[self::_keyLast($from)];
    }

    /**
     * Applies the callback to the values of the given arrays
     *
     * @see \array_map
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/map
     */
    protected static function __map(array $from, callable $callback) : array{
        $array = [];
        foreach($from as $key => $value){
            $array[$key] = $callback($value, $key, $from);
        }
        return $array;
    }

    /** All similar to @see __map(), but this applies to both keys and values */
    protected static function __mapAssoc(array $from, callable $callback) : array{
        $array = [];
        foreach($from as $key => $value){
            [$newKey, $newValue] = $callback($value, $key, $from);
            $array[$newKey] = $newValue;
        }
        return $array;
    }

    /** All similar to @see __map(), but this applies to keys */
    protected static function __mapKey(array $from, callable $callback) : array{
        $array = [];
        foreach($from as $key => $value){
            $array[$callback($value, $key, $from)] = $value;
        }
        return $array;
    }

    /**
     * Alias of @see __concat()
     *
     * @params mixed ...$value
     */
    protected static function __merge(...$values) : array{
        return self::__concat(...$values);
    }

    /**
     * Alias of @see __concatSoft()
     *
     * @params mixed ...$value
     */
    protected static function __mergeSoft(...$values) : array{
        return self::__concatSoft(...$values);
    }

    /**
     * Pad array to the specified length with a value
     *
     * @see \array_pad
     * @url https://www.php.net/manual/en/function.array-pad.php
     */
    protected static function __pad(array $from, int $size, $value){
        return array_pad($from, $size, $value);
    }

    /**
     * Removes the last element and returns that element
     *
     * @see \array_pop
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/pop
     */
    protected static function _pop(array &$from){
        return array_pop($from);
    }

    /**
     * Push elements onto the end of array
     *
     * @see \array_push
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/push
     */
    protected static function __push(array $from, ...$values){
        array_push($from, ...$values);
        return $from;
    }

    /** Returns the value at the result of @see _keyRandom() */
    protected static function _random(array $from){
        return $from[self::_keyRandom($from)];
    }

    /**
     * Executes a reducer function on each element of the array, resulting in single output value
     *
     * @see \array_reduce
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reduce
     */
    protected static function _reduce(array $from, callable $callback, $initialValue = null){
        $currentValue = $initialValue;
        foreach($from as $key => $value){
            $currentValue = $callback($currentValue, $value, $key, $from);
        }
        return $currentValue;
    }

    /** All similar to @see _reduce(), but reverse order */
    protected static function _reduceRight(array $from, callable $callback, $initialValue = null){
        $currentValue = $initialValue;
        foreach(array_reverse($from) as $key => $value){
            $currentValue = $callback($currentValue, $value, $key, $from);
        }
        return $currentValue;
    }

    /**
     * Replaces elements from passed arrays into the first array
     *
     * @see \array_replace_recursive
     * @url https://www.php.net/manual/en/function.array-replace-recursive.php
     */
    protected static function __replace(array $from, iterable ...$iterables){
        return array_replace_recursive($from, ...self::mapToArray($iterables));
    }

    /**
     * Returns an array with elements in reverse order
     *
     * @see \array_reverse
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reverse
     */
    protected static function __reverse(array $from, bool $preserveKeys = false) : array{
        return array_reverse($from, $preserveKeys);
    }

    /** Alias of @see _indexOf() */
    protected static function _search(array $from, $needle, int $start = 0){
        return self::_indexOf($from, $needle, $start);
    }

    /**
     * Removes the first element and returns that element
     *
     * @see \array_shift
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/shift
     */
    protected static function _shift(array &$from){
        return array_shift($from);
    }

    /**
     * Returns an array with selected from start to end
     * Extract a slice of the array
     *
     * @see \array_slice
     * @url https://www.php.net/manual/en/function.array-slice.php
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/slice
     */
    protected static function __slice(array $from, int $start = 0, int $end = null, bool $preserveKeys = false): array{
        $array = [];
        $keys = array_keys($from);
        $values = array_values($from);
        $count = count($from);
        $end = $end ?? $count;

        $i = $start < 0 ? max($count + $start, 0) : min($start, $count);
        $max = $end < 0 ? max($count + $end, 0) : min($end, $count);
        for(; $i < $max; ++$i){
            if($preserveKeys){
                $array[$keys[$i]] = $values[$i];
            }else{
                $array[] = $values[$i];
            }
        }

        return $array;
    }

    /**
     * Tests whether least one element pass the $callback function
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/some
     */
    protected static function _some(array $from, callable $callback) : bool{
        foreach($from as $key => $value){
            if($callback($value, $key, $from))
                return true;
        }
        return false;
    }

    /**
     * Sort an array by values using a $call function or default sort function
     *
     * @param callable|null $callback if is null, run sort(), else run usort()
     *
     * @see \usort
     * @url https://www.php.net/manual/en/function.usort.php
     *
     * @see \sort
     * @url https://www.php.net/manual/en/function.sort.php
     */
    protected static function __sort(array $from, ?callable $callback = null): array{
        if($callback === null){
            sort($from);
        }else{
            usort($from, $callback);
        }
        return $from;
    }

    /**
     * Sort an array by keys using a $call function or default sort function
     *
     * @param callable|null $callback if is null, run ksort(), else run uksort()
     *
     * @see \uksort
     * @url https://www.php.net/manual/en/function.uksort.php
     *
     * @see \ksort
     * @url https://www.php.net/manual/en/function.ksort.php
     */
    protected static function __sortKey(array $from, ?callable $callback = null) : array{
        if($callback === null){
            ksort($from);
        }else{
            uksort($from, $callback);
        }
        return $from;
    }

    /**
     * Remove a portion of the array and replace it with something else
     *
     * @param int|null $length = count($this)
     *
     * @see \array_splice
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/splice
     */
    protected static function _splice(array &$from, int $offset, ?int $length = null, ...$replacement) : array{
        return array_splice($from, $offset, $length ?? count($from), $replacement);
    }

    /**
     * Calculate the sum of values in an array
     *
     * @return int|float
     *
     * @see \array_sum
     * @url https://www.php.net/manual/en/function.array-sum.php
     */
    protected static function _sum(array $from){
        return array_sum($from);
    }

    /**
     * Removes duplicate values from an array
     *
     * @see \array_unique
     * @url https://www.php.net/manual/en/function.array-unique.php
     */
    protected static function __unique(array $from, int $sortFlags = SORT_STRING){
        return array_unique($from, $sortFlags);
    }

    /**
     * Push elements onto the start of array
     *
     * @see \array_unshift
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/unshift
     */
    protected static function __unshift(array $from, ...$values){
        array_unshift($from, ...$values);
        return $from;
    }

    /**
     * Returns all the values of an array
     *
     * @see \array_values
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/values
     */
    protected static function __values(array $from){
        return array_values($from);
    }

    /** @throws \BadMethodCallException */
    public function __call(string $name, array $arguments){
        if($raw = substr($name, -2) === "As"){
            $name = substr($name, 0, -2);
        }

        if(method_exists(self::class, $method = "__$name")){
            //Mapping method calls omitting "__" (It is meaning result is array)
            $result = self::$method((array) $this, ...$arguments);
            return $raw || !is_array($result) ? $result : $this->exchange($result);
        }elseif(method_exists(self::class, $method = "_$name")){
            //Mapping method calls omitting "_" (It is meaning result is not array)
            $array = (array) $this;
            $result = self::$method($array, ...$arguments);
            $this->exchangeArray($array);
            return $result;
        }else{
            throw new \BadMethodCallException("Call to undefined method " . self::class . "::$name()");
        }
    }

    /**
     * Process static accessing to use ArrayUtils quickly
     *
     * @throws \BadMethodCallException
     */
    public static function __callStatic(string $name, array $arguments){
        if(($pos = strpos($name, "From")) !== false){
            $name = substr_replace($name, "", $pos, 4);
        }
        $instance = self::from(array_shift($arguments));
        return $instance->$name(...$arguments);
    }
}