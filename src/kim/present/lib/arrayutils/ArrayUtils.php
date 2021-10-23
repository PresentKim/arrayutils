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
use BadMethodCallException;

use function array_chunk;
use function array_column;
use function array_combine;
use function array_count_values;
use function array_diff;
use function array_diff_assoc;
use function array_diff_key;
use function array_fill_keys;
use function array_flip;
use function array_intersect;
use function array_intersect_assoc;
use function array_intersect_key;
use function array_keys;
use function array_merge;
use function array_pad;
use function array_pop;
use function array_push;
use function array_replace_recursive;
use function array_reverse;
use function array_shift;
use function array_splice;
use function array_sum;
use function array_unique;
use function array_unshift;
use function array_values;
use function count;
use function implode;
use function is_array;
use function ksort;
use function max;
use function method_exists;
use function min;
use function rand;
use function sort;
use function strpos;
use function substr;
use function substr_replace;
use function uksort;
use function usort;

/**
 * Class ArrayUtils is provides a method to fancy manipulate an array
 *
 * Declare methods that implements internal array functions,
 * And methods that implements javascript array methods
 *
 * @link https://arrayutils.docs.present.kim/
 *
 * ===================================
 *
 * @see ArrayUtils::__chunk()
 * @method        ArrayUtils chunk(int $size, bool $preserveKeys = false)
 * @method        array      chunkAs(int $size, bool $preserveKeys = false)
 * @method static ArrayUtils chunkFrom(iterable $from, int $size, bool $preserveKeys = false)
 * @method static array      chunkFromAs(iterable $from, int $size, bool $preserveKeys = false)
 *
 * @see ArrayUtils::__column()
 * @method        ArrayUtils column(mixed $valueKey, mixed $indexKey = null)
 * @method        array      columnAs(mixed $valueKey, mixed $indexKey = null)
 * @method static ArrayUtils columnFrom(iterable $from, mixed $valueKey, mixed $indexKey = null)
 * @method static array      columnFromAs(iterable $from, mixed $valueKey, mixed $indexKey = null)
 *
 * @see ArrayUtils::__combine()
 * @method        ArrayUtils combine(iterable|null $valueArray = null)
 * @method        array      combineAs(iterable|null $valueArray = null)
 * @method static ArrayUtils combineFrom(iterable $from, iterable|null $valueArray = null)
 * @method static array      combineFromAs(iterable $from, iterable|null $valueArray = null)
 *
 * @see ArrayUtils::__concat()
 * @method        ArrayUtils concat(mixed ...$values)
 * @method        array      concatAs(mixed ...$values)
 * @method static ArrayUtils concatFrom(mixed ...$values)
 * @method static array      concatFromAs(mixed ...$values)
 *
 * @see ArrayUtils::__concatSoft()
 * @method        ArrayUtils concatSoft(mixed ...$values)
 * @method        array      concatSoftAs(mixed ...$values)
 * @method static ArrayUtils concatSoftFrom(mixed ...$values)
 * @method static array      concatSoftFromAs(mixed ...$values)
 *
 * @see ArrayUtils::__countValues()
 * @method        ArrayUtils countValues()
 * @method        array      countValuesAs()
 * @method static ArrayUtils countValuesFrom(iterable $from)
 * @method static array      countValuesFromAs(iterable $from)
 *
 * @see ArrayUtils::__diff()
 * @method        ArrayUtils diff(iterable ...$iterables)
 * @method        array      diffAs(iterable ...$iterables)
 * @method static ArrayUtils diffFrom(iterable $from, iterable ...$iterables)
 * @method static array      diffFromAs(iterable $from, iterable ...$iterables)
 *
 * @see ArrayUtils::__diffAssoc()
 * @method        ArrayUtils diffAssoc(iterable ...$iterables)
 * @method        array      diffAssocAs(iterable ...$iterables)
 * @method static ArrayUtils diffAssocFrom(iterable $from, iterable ...$iterables)
 * @method static array      diffAssocFromAs(iterable $from, iterable ...$iterables)
 *
 * @see ArrayUtils::__diffKey()
 * @method        ArrayUtils diffKey(iterable ...$iterables)
 * @method        array      diffKeyAs(iterable ...$iterables)
 * @method static ArrayUtils diffKeyFrom(iterable $from, iterable ...$iterables)
 * @method static array      diffKeyFromAs(iterable $from, iterable ...$iterables)
 *
 * @see ArrayUtils::__fill()
 * @method        ArrayUtils fill(mixed $value, int $start = 0, int $end = null)
 * @method        array      fillAs(mixed $value, int $start = 0, int $end = null)
 * @method static ArrayUtils fillFrom(iterable $from, mixed $value, int $start = 0, int $end = null)
 * @method static array      fillFromAs(iterable $from, mixed $value, int $start = 0, int $end = null)
 *
 * @see ArrayUtils::__fillKeys()
 * @method        ArrayUtils fillKeys(mixed $value)
 * @method        array      fillKeysAs(mixed $value)
 * @method static ArrayUtils fillKeysFrom(iterable $from, mixed $value)
 * @method static array      fillKeysFromAs(iterable $from, mixed $value)
 *
 * @see ArrayUtils::__filter()
 * @method        ArrayUtils filter(callable $callback)
 * @method        array      filterAs(callable $callback)
 * @method static ArrayUtils filterFrom(iterable $from, callable $callback)
 * @method static array      filterFromAs(iterable $from, callable $callback)
 *
 * @see ArrayUtils::__flat()
 * @method        ArrayUtils flat(int $dept = 1)
 * @method        array      flatAs(int $dept = 1)
 * @method static ArrayUtils flatFrom(iterable $from, int $dept = 1)
 * @method static array      flatFromAs(iterable $from, int $dept = 1)
 *
 * @see ArrayUtils::__flatMap()
 * @method        ArrayUtils flatMap(callable $callback)
 * @method        array      flatMapAs(callable $callback)
 * @method static ArrayUtils flatMapFrom(iterable $from, callable $callback)
 * @method static array      flatMapFromAs(iterable $from, callable $callback)
 *
 * @see ArrayUtils::__flip()
 * @method        ArrayUtils flip()
 * @method        array      flipAs()
 * @method static ArrayUtils flipFrom(iterable $from)
 * @method static array      flipFromAs(iterable $from)
 *
 * @see ArrayUtils::__forEach()
 * @method        ArrayUtils forEach(callable $callback)
 * @method        array      forEachAs(callable $callback)
 * @method static ArrayUtils forEachFrom(iterable $from, callable $callback)
 * @method static array      forEachFromAs(iterable $from, callable $callback)
 *
 * @see ArrayUtils::__intersect()
 * @method        ArrayUtils intersect(iterable ...$iterables)
 * @method        array      intersectAs(iterable ...$iterables)
 * @method static ArrayUtils intersectFrom(iterable $from, iterable ...$iterables)
 * @method static array      intersectFromAs(iterable $from, iterable ...$iterables)
 *
 * @see ArrayUtils::__intersectAssoc()
 * @method        ArrayUtils intersectAssoc(iterable ...$iterables)
 * @method        array      intersectAssocAs(iterable ...$iterables)
 * @method static ArrayUtils intersectAssocFrom(iterable $from, iterable ...$iterables)
 * @method static array      intersectAssocFromAs(iterable $from, iterable ...$iterables)
 *
 * @see ArrayUtils::__intersectkey()
 * @method        ArrayUtils intersectkey(iterable ...$iterables)
 * @method        array      intersectkeyAs(iterable ...$iterables)
 * @method static ArrayUtils intersectkeyFrom(iterable $from, iterable ...$iterables)
 * @method static array      intersectkeyFromAs(iterable $from, iterable ...$iterables)
 *
 * @see ArrayUtils::__keys()
 * @method        ArrayUtils keys()
 * @method        array      keysAs()
 * @method static ArrayUtils keysFrom(iterable $from)
 * @method static array      keysFromAs(iterable $from)
 *
 * @see ArrayUtils::__map()
 * @method        ArrayUtils map(callable $callback)
 * @method        array      mapAs(callable $callback)
 * @method static ArrayUtils mapFrom(iterable $from, callable $callback)
 * @method static array      mapFromAs(iterable $from, callable $callback)
 *
 * @see ArrayUtils::__mapAssoc()
 * @method        ArrayUtils mapAssoc(callable $callback)
 * @method        array      mapAssocAs(callable $callback)
 * @method static ArrayUtils mapAssocFrom(iterable $from, callable $callback)
 * @method static array      mapAssocFromAs(iterable $from, callable $callback)
 *
 * @see ArrayUtils::__mapKey()
 * @method        ArrayUtils mapKey(callable $callback)
 * @method        array      mapKeyAs(callable $callback)
 * @method static ArrayUtils mapKeyFrom(iterable $from, callable $callback)
 * @method static array      mapKeyFromAs(iterable $from, callable $callback)
 *
 * @see ArrayUtils::__merge()
 * @method        ArrayUtils merge(mixed ...$iterables)
 * @method        array      mergeAs(mixed ...$iterables)
 * @method static ArrayUtils mergeFrom(mixed ...$iterables)
 * @method static array      mergeFromAs(mixed ...$iterables)
 *
 * @see ArrayUtils::__mergeSoft()
 * @method        ArrayUtils mergeSoft(mixed ...$iterables)
 * @method        array      mergeSoftAs(mixed ...$iterables)
 * @method static ArrayUtils mergeSoftFrom(iterable $from, mixed ...$iterables)
 * @method static array      mergeSoftFromAs(iterable $from, mixed ...$iterables)
 *
 * @see ArrayUtils::__pad()
 * @method        ArrayUtils pad(int $size, mixed $value)
 * @method        array      padAs(int $size, mixed $value)
 * @method static ArrayUtils padFrom(iterable $from, int $size, mixed $value)
 * @method static array      padFromAs(iterable $from, int $size, mixed $value)
 *
 * @see ArrayUtils::__push()
 * @method        ArrayUtils push(mixed ...$values)
 * @method        array      pushAs(mixed ...$values)
 * @method static ArrayUtils pushFrom(iterable $from, mixed ...$values)
 * @method static array      pushFromAs(iterable $from, mixed ...$values)
 *
 * @see ArrayUtils::__replace()
 * @method        ArrayUtils replace(iterable ...$iterables)
 * @method        array      replaceAs(iterable ...$iterables)
 * @method static ArrayUtils replaceFrom(iterable $from, iterable ...$iterables)
 * @method static array      replaceFromAs(iterable $from, iterable ...$iterables)
 *
 * @see ArrayUtils::__reverse()
 * @method        ArrayUtils reverse(bool $preserveKeys = false)
 * @method        array      reverseAs(bool $preserveKeys = false)
 * @method static ArrayUtils reverseFrom(iterable $from, bool $preserveKeys = false)
 * @method static array      reverseFromAs(iterable $from, bool $preserveKeys = false)
 *
 * @see ArrayUtils::__slice()
 * @method        ArrayUtils slice(int $start = 0, int $end = null, bool $preserveKeys = false)
 * @method        array      sliceAs(int $start = 0, int $end = null, bool $preserveKeys = false)
 * @method static ArrayUtils sliceFrom(iterable $from, int $start = 0, int $end = null, bool $preserveKeys = false)
 * @method static array      sliceFromAs(iterable $from, int $start = 0, int $end = null, bool $preserveKeys = false)
 *
 * @see ArrayUtils::__sort()
 * @method        ArrayUtils sort(?callable $callback = null)
 * @method        array      sortAs(?callable $callback = null)
 * @method static ArrayUtils sortFrom(iterable $from, ?callable $callback = null)
 * @method static array      sortFromAs(iterable $from, ?callable $callback = null)
 *
 * @see ArrayUtils::__sortKey()
 * @method        ArrayUtils sortKey(?callable $callback = null)
 * @method        array      sortKeyAs(?callable $callback = null)
 * @method static ArrayUtils sortKeyFrom(iterable $from, ?callable $callback = null)
 * @method static array      sortKeyFromAs(iterable $from, ?callable $callback = null)
 *
 * @see ArrayUtils::__unique()
 * @method        ArrayUtils unique(int $sortFlags = SORT_STRING)
 * @method        array      uniqueAs(int $sortFlags = SORT_STRING)
 * @method static ArrayUtils uniqueFrom(iterable $from, int $sortFlags = SORT_STRING)
 * @method static array      uniqueFromAs(iterable $from, int $sortFlags = SORT_STRING)
 *
 * @see ArrayUtils::__unshift()
 * @method        ArrayUtils unshift(mixed ...$values)
 * @method        array      unshiftAs(mixed ...$values)
 * @method static ArrayUtils unshiftFrom(iterable $from, mixed ...$values)
 * @method static array      unshiftFromAs(iterable $from, mixed ...$values)
 *
 * @see ArrayUtils::__values()
 * @method        ArrayUtils values()
 * @method        array      valuesAs()
 * @method static ArrayUtils valuesFrom(iterable $from)
 * @method static array      valuesFromAs(iterable $from)
 *
 * @see ArrayUtils::_every()
 * @method        bool       every(callable $callback)
 * @method static bool       everyFrom(iterable $from, callable $callback)
 *
 * @see ArrayUtils::_includes()
 * @method        bool       includes(mixed $needle, int $start = 0)
 * @method static bool       includesFrom(iterable $from, mixed $needle, int $start = 0)
 *
 * @see ArrayUtils::_keyExists()
 * @method        bool       keyExists(int|string $key)
 * @method static bool       keyExistsFrom(iterable $from, int|string $key)
 *
 * @see ArrayUtils::_some()
 * @method        bool       some(callable $callback)
 * @method static bool       someFrom(iterable $from, callable $callback)
 *
 * @see ArrayUtils::_sum()
 * @method        int|float  sum()
 * @method static int|float  sumFrom(iterable $from)
 *
 * @see ArrayUtils::_find()
 * @method        mixed      find(callable $callback)
 * @method static mixed      findFrom(iterable $from, callable $callback)
 *
 * @see ArrayUtils::_findIndex()
 * @method        int|string|null findIndex(callable $callback)
 * @method static int|string|null findIndexFrom(iterable $from, callable $callback)
 *
 * @see ArrayUtils::_first()
 * @method        mixed      first()
 * @method static mixed      firstFrom(iterable $from)
 *
 * @see ArrayUtils::_indexOf()
 * @method        int|string|null indexOf(mixed $needle, int $start = 0)
 * @method static int|string|null indexOfFrom(iterable $from, mixed $needle, int $start = 0)
 *
 * @see ArrayUtils::_keyFirst()
 * @method        int|string|null keyFirst()
 * @method static int|string|null keyFirstFrom(iterable $from)
 *
 * @see ArrayUtils::_keyLast()
 * @method        int|string|null keyLast()
 * @method static int|string|null keyLastFrom(iterable $from)
 *
 * @see ArrayUtils::_keyRandom()
 * @method        int|string|null keyRandom()
 * @method static int|string|null keyRandomFrom(iterable $from)
 *
 * @see ArrayUtils::_last()
 * @method        mixed      last()
 * @method static mixed      lastFrom(iterable $from)
 *
 * @see ArrayUtils::_pop()
 * @method        mixed      pop()
 * @method static mixed      popFrom(iterable &$from)
 *
 * @see ArrayUtils::_random()
 * @method        mixed      random()
 * @method static mixed      randomFrom(iterable $from)
 *
 * @see ArrayUtils::_reduce()
 * @method        mixed      reduce(callable $callback, mixed $initialValue = null)
 * @method static mixed      reduceFrom(iterable $from, callable $callback, mixed $initialValue = null)
 *
 * @see ArrayUtils::_reduceRight()
 * @method        mixed      reduceRight(callable $callback, mixed $initialValue = null)
 * @method static mixed      reduceRightFrom(iterable $from, callable $callback, mixed $initialValue = null)
 *
 * @see ArrayUtils::_search()
 * @method        mixed      search(mixed $needle, int $start = 0)
 * @method static mixed      searchFrom(iterable $from, mixed $needle, int $start = 0)
 *
 * @see ArrayUtils::_shift()
 * @method        mixed      shift()
 * @method static mixed      shiftFrom(iterable &$from)
 *
 * @see ArrayUtils::_splice()
 * @method        array      splice(int $offset, ?int $length = null, mixed ...$replacement)
 * @method static array      spliceFrom(iterable $from, int $offset, ?int $length = null, mixed ...$replacement)
 *
 * @see ArrayUtils::_join()
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
     * @link https://arrayutils.docs.present.kim/methods/s/from
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
     * @link https://arrayutils.docs.present.kim/methods/s/of
     */
    public static function of(...$elements) : ArrayUtils{
        return new self($elements);
    }

    /**
     * Cast all elements of the iterable to an array
     *
     * @link https://arrayutils.docs.present.kim/methods/s/maptoarray
     */
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
     * @link https://arrayutils.docs.present.kim/methods/c/chunk
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
     * @link https://arrayutils.docs.present.kim/methods/c/column
     */
    protected static function __column(array $from, $valueKey, $indexKey = null) : array{
        return array_column($from, $valueKey, $indexKey);
    }

    /**
     * Creates an array by using one array for keys and another for its values
     *
     * @param array|null $valueArray If is null, Use self clone
     *
     * @link https://arrayutils.docs.present.kim/methods/c/combine
     */
    protected static function __combine(array $from, ?iterable $valueArray = null) : array{
        return array_combine($from, (array) ($valueArray ?? $from));
    }

    /**
     * Merge one or more arrays
     *
     * @params mixed ...$value
     *
     * @link https://arrayutils.docs.present.kim/methods/c/concat
     */
    protected static function __concat(...$values) : array{
        return array_merge(...self::mapToArray($values));
    }

    /**
     * All similar to @see ArrayUtils::__concat(), but not overwrite existing keys
     *
     * @params mixed ...$value
     *
     * @link https://arrayutils.docs.present.kim/methods/c/concat/soft
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
     * @link https://arrayutils.docs.present.kim/methods/c/count-values
     */
    protected static function __countValues(array $from) : array{
        return array_count_values($from);
    }

    /**
     * Computes the difference of arrays
     *
     * @link https://arrayutils.docs.present.kim/methods/c/diff
     */
    protected static function __diff(array $from, iterable ...$iterables) : array{
        return array_diff($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see ArrayUtils::__diff(), but this applies with additional index check
     *
     * @link https://arrayutils.docs.present.kim/methods/c/diff/assoc
     */
    protected static function __diffAssoc(array $from, iterable ...$iterables) : array{
        return array_diff_assoc($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see ArrayUtils::__diff(), but this applies to keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/diff/key
     */
    protected static function __diffKey(array $from, iterable ...$iterables) : array{
        return array_diff_key($from, ...self::mapToArray($iterables));
    }

    /**
     * Tests whether all elements pass the $callback function
     *
     * @link https://arrayutils.docs.present.kim/methods/c/fill
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
     * @link https://arrayutils.docs.present.kim/methods/c/fill/keys
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
     * @link https://arrayutils.docs.present.kim/methods/c/fill/keys
     */
    protected static function __fillKeys(array $from, $value) : array{
        return array_fill_keys($from, $value);
    }

    /**
     * Returns a new array with all elements that pass the $callback function
     *
     * @link https://arrayutils.docs.present.kim/methods/c/filter
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
     * Returns a new array with all sub-array elements concatenated into it recursively up to the specified depth
     *
     * @link https://arrayutils.docs.present.kim/methods/c/flat
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
     * @link https://arrayutils.docs.present.kim/methods/c/flat/map
     */
    protected static function __flatMap(array $from, callable $callback) : array{
        return self::__concat(...self::__map($from, $callback));
    }

    /**
     * Exchanges all keys with their associated values in an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/flip
     */
    protected static function __flip(array $from) : array{
        return array_flip($from);
    }

    /**
     * Executes a $callback function once for each array element.
     *
     * @link https://arrayutils.docs.present.kim/methods/c/for-each
     */
    protected static function __forEach(array $from, callable $callback) : array{
        foreach($from as $key => $value){
            $callback($value, $key, $from);
        }
        return $from;
    }

    /**
     * Computes the intersection of arrays
     *
     * @link https://arrayutils.docs.present.kim/methods/c/intersect
     */
    protected static function __intersect(array $from, iterable ...$iterables) : array{
        return array_intersect($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see ArrayUtils::__intersect(), but this applies to both keys and values
     *
     * @link https://arrayutils.docs.present.kim/methods/c/intersect/assoc
     */
    protected static function __intersectAssoc(array $from, iterable ...$iterables) : array{
        return array_intersect_assoc($from, ...self::mapToArray($iterables));
    }

    /**
     * All similar to @see ArrayUtils::__intersect(), but this applies to keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/intersect/key
     */
    protected static function __intersectkey(array $from, iterable ...$iterables) : array{
        return array_intersect_key($from, ...self::mapToArray($iterables));
    }

    /**
     * Returns all the keys of an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/keys
     */
    protected static function __keys(array $from) : array{
        return array_keys($from);
    }

    /**
     * Applies the callback to the values of the given arrays
     *
     * @link https://arrayutils.docs.present.kim/methods/c/map
     */
    protected static function __map(array $from, callable $callback) : array{
        $array = [];
        foreach($from as $key => $value){
            $array[$key] = $callback($value, $key, $from);
        }
        return $array;
    }

    /**
     * All similar to @see ArrayUtils::__map(), but this applies to both keys and values
     *
     * @link https://arrayutils.docs.present.kim/methods/c/map/assoc
     */
    protected static function __mapAssoc(array $from, callable $callback) : array{
        $array = [];
        foreach($from as $key => $value){
            [$newKey, $newValue] = $callback($value, $key, $from);
            $array[$newKey] = $newValue;
        }
        return $array;
    }

    /**
     * All similar to @see ArrayUtils::__map(), but this applies to keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/map/key
     */
    protected static function __mapKey(array $from, callable $callback) : array{
        $array = [];
        foreach($from as $key => $value){
            $array[$callback($value, $key, $from)] = $value;
        }
        return $array;
    }

    /**
     * Pad array to the specified length with a value
     *
     * @link https://arrayutils.docs.present.kim/methods/c/pad
     */
    protected static function __pad(array $from, int $size, $value) : array{
        return array_pad($from, $size, $value);
    }

    /**
     * Push elements onto the end of array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/push
     */
    protected static function __push(array $from, ...$values) : array{
        array_push($from, ...$values);
        return $from;
    }

    /**
     * Replaces elements from passed arrays into the first array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/replace
     */
    protected static function __replace(array $from, iterable ...$iterables) : array{
        return array_replace_recursive($from, ...self::mapToArray($iterables));
    }

    /**
     * Returns an array with elements in reverse order
     *
     * @link https://arrayutils.docs.present.kim/methods/c/reverse
     */
    protected static function __reverse(array $from, bool $preserveKeys = false) : array{
        return array_reverse($from, $preserveKeys);
    }

    /**
     * Returns an array with selected from start to end
     * Extract a slice of the array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/slice
     */
    protected static function __slice(array $from, int $start = 0, int $end = null, bool $preserveKeys = false) : array{
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
     * Sort an array by values using a $call function or default sort function
     *
     * @param callable|null $callback if is null, run sort(), else run usort()
     *
     * @link https://arrayutils.docs.present.kim/methods/c/sort
     */
    protected static function __sort(array $from, ?callable $callback = null) : array{
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
     * @link https://arrayutils.docs.present.kim/methods/c/sort/key
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
     * Removes duplicate values from an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/unique
     */
    protected static function __unique(array $from, int $sortFlags = SORT_STRING) : array{
        return array_unique($from, $sortFlags);
    }

    /**
     * Push elements onto the start of array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/unshift
     */
    protected static function __unshift(array $from, ...$values) : array{
        array_unshift($from, ...$values);
        return $from;
    }

    /**
     * Returns all the values of an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/values
     */
    protected static function __values(array $from) : array{
        return array_values($from);
    }

    /**
     * Join array elements with a string. You can specify a suffix and prefix
     *
     * @link https://arrayutils.docs.present.kim/methods/g/join
     */
    protected static function _join(array $from, string $glue = ",", string $prefix = "", string $suffix = "") : string{
        return $prefix . implode($glue, $from) . $suffix;
    }

    /**
     * Tests whether an array includes a $needle
     *
     * @link https://arrayutils.docs.present.kim/methods/g/includes
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
     * Alias of @see offsetExists()
     *
     * @link https://arrayutils.docs.present.kim/methods/g/key-exists
     */
    protected static function _keyExists(array $from, $key) : bool{
        return isset($from[$key]);
    }

    /**
     * Returns the first index at which a given element can be found in the array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/index-of
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
     * Returns the value of the first element that that pass the $callback function
     *
     * @return mixed;
     *
     * @link https://arrayutils.docs.present.kim/methods/g/find
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
     * @link https://arrayutils.docs.present.kim/methods/g/find/index
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
     * @link https://arrayutils.docs.present.kim/methods/g/first
     */
    protected static function _first(array $from){
        return $from[self::_keyFirst($from)];
    }

    /**
     * Gets the first key of an array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/first/key
     */
    protected static function _keyFirst(array $from){
        return array_keys($from)[0] ?? null;
    }

    /**
     * Returns the value at the result of @see ArrayUtils::_keyLast()
     *
     * @link https://arrayutils.docs.present.kim/methods/g/last
     */
    protected static function _last(array $from){
        return $from[self::_keyLast($from)];
    }

    /**
     * Gets the last key of an array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/last/key
     */
    protected static function _keyLast(array $from){
        return array_keys($from)[count($from) - 1] ?? null;
    }

    /**
     * Returns the value at the result of @see ArrayUtils::_keyRandom()
     *
     * @link https://arrayutils.docs.present.kim/methods/g/random
     */
    protected static function _random(array $from){
        return $from[self::_keyRandom($from)];
    }

    /**
     * Gets the random key of an array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/random/key
     */
    protected static function _keyRandom(array $from){
        return ($keys = array_keys($from))[rand(0, count($keys) - 1)] ?? null;
    }

    /**
     * Removes the last element and returns that element
     *
     * @link https://arrayutils.docs.present.kim/methods/g/pop
     */
    protected static function _pop(array &$from){
        return array_pop($from);
    }

    /**
     * Executes a reducer function on each element of the array, resulting in single output value
     *
     * @link https://arrayutils.docs.present.kim/methods/g/reduce
     */
    protected static function _reduce(array $from, callable $callback, $initialValue = null){
        $currentValue = $initialValue;
        foreach($from as $key => $value){
            $currentValue = $callback($currentValue, $value, $key, $from);
        }
        return $currentValue;
    }

    /**
     * All similar to @see ArrayUtils::_reduce(), but reverse order
     *
     * @link https://arrayutils.docs.present.kim/methods/g/reduce/right
     */
    protected static function _reduceRight(array $from, callable $callback, $initialValue = null){
        $currentValue = $initialValue;
        foreach(array_reverse($from) as $key => $value){
            $currentValue = $callback($currentValue, $value, $key, $from);
        }
        return $currentValue;
    }

    /**
     * Removes the first element and returns that element
     *
     * @link https://arrayutils.docs.present.kim/methods/g/shift
     */
    protected static function _shift(array &$from){
        return array_shift($from);
    }

    /**
     * Tests whether least one element pass the $callback function
     *
     * @link https://arrayutils.docs.present.kim/methods/g/some
     */
    protected static function _some(array $from, callable $callback) : bool{
        foreach($from as $key => $value){
            if($callback($value, $key, $from))
                return true;
        }
        return false;
    }

    /**
     * Remove a portion of the array and replace it with something else
     *
     * @param int|null $length = count($this)
     *
     * @link https://arrayutils.docs.present.kim/methods/g/splice
     */
    protected static function _splice(array &$from, int $offset, ?int $length = null, ...$replacement) : array{
        return array_splice($from, $offset, $length ?? count($from), $replacement);
    }

    /**
     * Calculate the sum of values in an array
     *
     * @return int|float
     *
     * @link https://arrayutils.docs.present.kim/methods/g/sum
     */
    protected static function _sum(array $from){
        return array_sum($from);
    }

    /** Alias of @see ArrayUtils::__concat() */
    protected static function __merge(...$values) : array{
        return self::__concat(...$values);
    }

    /** Alias of @see ArrayUtils::__concatSoft() */
    protected static function __mergeSoft(...$values) : array{
        return self::__concatSoft(...$values);
    }

    /** Alias of @see ArrayUtils::_indexOf() */
    protected static function _search(array $from, $needle, int $start = 0){
        return self::_indexOf($from, $needle, $start);
    }

    /** @throws BadMethodCallException */
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
            throw new BadMethodCallException("Call to undefined method " . self::class . "::$name()");
        }
    }

    /**
     * Process static accessing to use ArrayUtils quickly
     *
     * @throws BadMethodCallException
     */
    public static function __callStatic(string $name, array $arguments){
        if(($pos = strpos($name, "From")) !== false){
            $name = substr_replace($name, "", $pos, 4);
        }
        $instance = self::from(array_shift($arguments));
        return $instance->$name(...$arguments);
    }
}