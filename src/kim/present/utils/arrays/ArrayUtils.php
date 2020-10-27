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

use ArrayObject;
use iterable;

/**
 * Class ArrayUtils is provides a method to fancy manipulate an array
 *
 * Declare methods that implements internal array functions,
 * And methods that implements javascript array methods
 *
 * @link https://www.php.net/manual/en/ref.array.php
 * @link https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array
 *
 * @param array|ArrayObject|iterable|mixed ...$values if is not array-like, wrap value in an array
 *
 * ===================================
 *
 * @method        ArrayUtils chunk(int $size, bool $preserveKeys = false)
 * @method        array      chunkAs(int $size, bool $preserveKeys = false)
 * @method static ArrayUtils chunkFrom(array|ArrayObject|iterable $from, int $size, bool $preserveKeys = false)
 * @method static array      chunkFromAs(array|ArrayObject|iterable $from, int $size, bool $preserveKeys = false)
 *
 * @method        ArrayUtils column(mixed $column_key, mixed $indexKey = null)
 * @method        array      columnAs(mixed $column_key, mixed $indexKey = null)
 * @method static ArrayUtils columnFrom(array|ArrayObject|iterable $from, mixed $column_key, mixed $indexKey = null)
 * @method static array      columnFromAs(array|ArrayObject|iterable $from, mixed $column_key, mixed $indexKey = null)
 *
 * @method        ArrayUtils combine(array|ArrayObject|iterable|null $arrayLikes = null)
 * @method        array      combineAs(array|ArrayObject|iterable|null $arrayLikes = null)
 * @method static ArrayUtils combineFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable|null $arrayLikes = null)
 * @method static array      combineFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable|null $arrayLikes = null)
 *
 * @method        ArrayUtils concat(mixed ...$arrayLikes)
 * @method        array      concatAs(mixed ...$arrayLikes)
 * @method static ArrayUtils concatFrom(mixed ...$arrayLikes)
 * @method static array      concatFromAs(mixed ...$arrayLikes)
 *
 * @method        ArrayUtils concatSoft(mixed ...$arrayLikes)
 * @method        array      concatSoftAs(mixed ...$arrayLikes)
 * @method static ArrayUtils concatSoftFrom(mixed ...$arrayLikes)
 * @method static array      concatSoftFromAs(mixed ...$arrayLikes)
 *
 * @method        ArrayUtils countValues()
 * @method        array      countValuesAs()
 * @method static ArrayUtils countValuesFrom(array|ArrayObject|iterable $from)
 * @method static array      countValuesFromAs(array|ArrayObject|iterable $from)
 *
 * @method        ArrayUtils diff(array|ArrayObject|iterable ...$arrayLikes)
 * @method        array      diffAs(array|ArrayObject|iterable ...$arrayLikes)
 * @method static ArrayUtils diffFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 * @method static array      diffFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 *
 * @method        ArrayUtils diffAssoc(array|ArrayObject|iterable ...$arrayLikes)
 * @method        array      diffAssocAs(array|ArrayObject|iterable ...$arrayLikes)
 * @method static ArrayUtils diffAssocFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 * @method static array      diffAssocFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 *
 * @method        ArrayUtils diffKey(array|ArrayObject|iterable ...$arrayLikes)
 * @method        array      diffKeyAs(array|ArrayObject|iterable ...$arrayLikes)
 * @method static ArrayUtils diffKeyFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 * @method static array      diffKeyFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 *
 * @method        ArrayUtils fill(mixed $value, int $start = 0, int $end = null)
 * @method        array      fillAs(mixed $value, int $start = 0, int $end = null)
 * @method static ArrayUtils fillFrom(array|ArrayObject|iterable $from, mixed $value, int $start = 0, int $end = null)
 * @method static array      fillFromAs(array|ArrayObject|iterable $from, mixed $value, int $start = 0, int $end = null)
 *
 * @method        ArrayUtils fillKeys(mixed $value)
 * @method        array      fillKeysAs(mixed $value)
 * @method static ArrayUtils fillKeysFrom(array|ArrayObject|iterable $from, mixed $value)
 * @method static array      fillKeysFromAs(array|ArrayObject|iterable $from, mixed $value)
 *
 * @method        ArrayUtils filter(callable $callback, int $flag = 0)
 * @method        array      filterAs(callable $callback, int $flag = 0)
 * @method static ArrayUtils filterFrom(array|ArrayObject|iterable $from, callable $callback, int $flag = 0)
 * @method static array      filterFromAs(array|ArrayObject|iterable $from, callable $callback, int $flag = 0)
 *
 * @method        ArrayUtils flat(int $dept = 1)
 * @method        array      flatAs(int $dept = 1)
 * @method static ArrayUtils flatFrom(array|ArrayObject|iterable $from, int $dept = 1)
 * @method static array      flatFromAs(array|ArrayObject|iterable $from, int $dept = 1)
 *
 * @method        ArrayUtils flatMap(callable $callback)
 * @method        array      flatMapAs(callable $callback)
 * @method static ArrayUtils flatMapFrom(array|ArrayObject|iterable $from, callable $callback)
 * @method static array      flatMapFromAs(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        ArrayUtils flip()
 * @method        array      flipAs()
 * @method static ArrayUtils flipFrom(array|ArrayObject|iterable $from)
 * @method static array      flipFromAs(array|ArrayObject|iterable $from)
 *
 * @method        ArrayUtils forEach(callable $callback)
 * @method        array      forEachAs(callable $callback)
 * @method static ArrayUtils forEachFrom(array|ArrayObject|iterable $from, callable $callback)
 * @method static array      forEachFromAs(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        ArrayUtils intersect(array|ArrayObject|iterable ...$arrayLikes)
 * @method        array      intersectAs(array|ArrayObject|iterable ...$arrayLikes)
 * @method static ArrayUtils intersectFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 * @method static array      intersectFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 *
 * @method        ArrayUtils intersectAssoc(array|ArrayObject|iterable ...$arrayLikes)
 * @method        array      intersectAssocAs(array|ArrayObject|iterable ...$arrayLikes)
 * @method static ArrayUtils intersectAssocFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 * @method static array      intersectAssocFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 *
 * @method        ArrayUtils intersectkey(array|ArrayObject|iterable ...$arrayLikes)
 * @method        array      intersectkeyAs(array|ArrayObject|iterable ...$arrayLikes)
 * @method static ArrayUtils intersectkeyFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 * @method static array      intersectkeyFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 *
 * @method        ArrayUtils keys()
 * @method        array      keysAs()
 * @method static ArrayUtils keysFrom(array|ArrayObject|iterable $from)
 * @method static array      keysFromAs(array|ArrayObject|iterable $from)
 *
 * @method        ArrayUtils map(callable $callback)
 * @method        array      mapAs(callable $callback)
 * @method static ArrayUtils mapFrom(array|ArrayObject|iterable $from, callable $callback)
 * @method static array      mapFromAs(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        ArrayUtils mapAssoc(callable $callback)
 * @method        array      mapAssocAs(callable $callback)
 * @method static ArrayUtils mapAssocFrom(array|ArrayObject|iterable $from, callable $callback)
 * @method static array      mapAssocFromAs(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        ArrayUtils mapKey(callable $callback)
 * @method        array      mapKeyAs(callable $callback)
 * @method static ArrayUtils mapKeyFrom(array|ArrayObject|iterable $from, callable $callback)
 * @method static array      mapKeyFromAs(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        ArrayUtils merge(mixed ...$arrayLikes)
 * @method        array      mergeAs(mixed ...$arrayLikes)
 * @method static ArrayUtils mergeFrom(mixed ...$arrayLikes)
 * @method static array      mergeFromAs(mixed ...$arrayLikes)
 *
 * @method        ArrayUtils mergeSoft(mixed ...$arrayLikes)
 * @method        array      mergeSoftAs(mixed ...$arrayLikes)
 * @method static ArrayUtils mergeSoftFrom(array|ArrayObject|iterable $from, mixed ...$arrayLikes)
 * @method static array      mergeSoftFromAs(array|ArrayObject|iterable $from, mixed ...$arrayLikes)
 *
 * @method        ArrayUtils pad(int $size, mixed $value)
 * @method        array      padAs(int $size, mixed $value)
 * @method static ArrayUtils padFrom(array|ArrayObject|iterable $from, int $size, mixed $value)
 * @method static array      padFromAs(array|ArrayObject|iterable $from, int $size, mixed $value)
 *
 * @method        ArrayUtils push(mixed ...$values)
 * @method        array      pushAs(mixed ...$values)
 * @method static ArrayUtils pushFrom(array|ArrayObject|iterable $from, mixed ...$values)
 * @method static array      pushFromAs(array|ArrayObject|iterable $from, mixed ...$values)
 *
 * @method        ArrayUtils replace(array|ArrayObject|iterable ...$arrayLikes)
 * @method        array      replaceAs(array|ArrayObject|iterable ...$arrayLikes)
 * @method static ArrayUtils replaceFrom(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 * @method static array      replaceFromAs(array|ArrayObject|iterable $from, array|ArrayObject|iterable ...$arrayLikes)
 *
 * @method        ArrayUtils reverse(bool $preserveKeys = false)
 * @method        array      reverseAs(bool $preserveKeys = false)
 * @method static ArrayUtils reverseFrom(array|ArrayObject|iterable $from, bool $preserveKeys = false)
 * @method static array      reverseFromAs(array|ArrayObject|iterable $from, bool $preserveKeys = false)
 *
 * @method        ArrayUtils slice(int $start = 0, int $end = null, mixed $preserve_keys = false)
 * @method        array      sliceAs(int $start = 0, int $end = null, mixed $preserve_keys = false)
 * @method static ArrayUtils sliceFrom(array|ArrayObject|iterable $from, int $start = 0, int $end = null, mixed $preserve_keys = false)
 * @method static array      sliceFromAs(array|ArrayObject|iterable $from, int $start = 0, int $end = null, mixed $preserve_keys = false)
 *
 * @method        ArrayUtils sort(?callable $callback = null)
 * @method        array      sortAs(?callable $callback = null)
 * @method static ArrayUtils sortFrom(array|ArrayObject|iterable $from, ?callable $callback = null)
 * @method static array      sortFromAs(array|ArrayObject|iterable $from, ?callable $callback = null)
 *
 * @method        ArrayUtils sortKey(?callable $callback = null)
 * @method        array      sortKeyAs(?callable $callback = null)
 * @method static ArrayUtils sortKeyFrom(array|ArrayObject|iterable $from, ?callable $callback = null)
 * @method static array      sortKeyFromAs(array|ArrayObject|iterable $from, ?callable $callback = null)
 *
 * @method        ArrayUtils splice(int $offset, ?int $length = null, mixed ...$replacement)
 * @method        array      spliceAs(int $offset, ?int $length = null, mixed ...$replacement)
 * @method static ArrayUtils spliceFrom(array|ArrayObject|iterable $from, int $offset, ?int $length = null, mixed ...$replacement)
 * @method static array      spliceFromAs(array|ArrayObject|iterable $from, int $offset, ?int $length = null, mixed ...$replacement)
 *
 * @method        ArrayUtils unique(int $sort_flags = SORT_STRING)
 * @method        array      uniqueAs(int $sort_flags = SORT_STRING)
 * @method static ArrayUtils uniqueFrom(array|ArrayObject|iterable $from, int $sort_flags = SORT_STRING)
 * @method static array      uniqueFromAs(array|ArrayObject|iterable $from, int $sort_flags = SORT_STRING)
 *
 * @method        ArrayUtils unshift(mixed ...$values)
 * @method        array      unshiftAs(mixed ...$values)
 * @method static ArrayUtils unshiftFrom(array|ArrayObject|iterable $from, mixed ...$values)
 * @method static array      unshiftFromAs(array|ArrayObject|iterable $from, mixed ...$values)
 *
 * @method        ArrayUtils values()
 * @method        array      valuesAs()
 * @method static ArrayUtils valuesFrom(array|ArrayObject|iterable $from)
 * @method static array      valuesFromAs(array|ArrayObject|iterable $from)
 *
 * @method        bool       every(callable $callback)
 * @method static bool       everyFrom(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        bool       includes(mixed $needle, int $start = 0)
 * @method static bool       includesFrom(array|ArrayObject|iterable $from, mixed $needle, int $start = 0)
 *
 * @method        bool       keyExists(mixed $key)
 * @method static bool       keyExistsFrom(array|ArrayObject|iterable $from, mixed $key)
 *
 * @method        bool       some(callable $callback)
 * @method static bool       someFrom(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        int|float  sum()
 * @method static int|float  sumFrom(array|ArrayObject|iterable $from)
 *
 * @method        mixed      find(callable $callback)
 * @method static mixed      findFrom(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        mixed      findIndex(callable $callback)
 * @method static mixed      findIndexFrom(array|ArrayObject|iterable $from, callable $callback)
 *
 * @method        mixed      first()
 * @method static mixed      firstFrom(array|ArrayObject|iterable $from)
 *
 * @method        mixed      indexOf(mixed $needle, int $start = 0)
 * @method static mixed      indexOfFrom(array|ArrayObject|iterable $from, mixed $needle, int $start = 0)
 *
 * @method        mixed      keyFirst()
 * @method static mixed      keyFirstFrom(array|ArrayObject|iterable $from)
 *
 * @method        mixed      keyLast()
 * @method static mixed      keyLastFrom(array|ArrayObject|iterable $from)
 *
 * @method        mixed      keyRandom()
 * @method static mixed      keyRandomFrom(array|ArrayObject|iterable $from)
 *
 * @method        mixed      last()
 * @method static mixed      lastFrom(array|ArrayObject|iterable $from)
 *
 * @method        mixed      pop()
 * @method static mixed      popFrom(array|ArrayObject|iterable &$from)
 *
 * @method        mixed      random()
 * @method static mixed      randomFrom(array|ArrayObject|iterable $from)
 *
 * @method        mixed      reduce(callable $callback, mixed $initialValue = null)
 * @method static mixed      reduceFrom(array|ArrayObject|iterable $from, callable $callback, mixed $initialValue = null)
 *
 * @method        mixed      reduceRight(callable $callback, mixed $initialValue = null)
 * @method static mixed      reduceRightFrom(array|ArrayObject|iterable $from, callable $callback, mixed $initialValue = null)
 *
 * @method        mixed      search(mixed $needle, int $start = 0)
 * @method static mixed      searchFrom(array|ArrayObject|iterable $from, mixed $needle, int $start = 0)
 *
 * @method        mixed      shift()
 * @method static mixed      shiftFrom(array|ArrayObject|iterable &$from)
 *
 * @method        string     join(string $glue = ",", string $prefix = "", string $suffix = "")
 * @method static string     joinFrom(array|ArrayObject|iterable $from, string $glue = ",", string $prefix = "", string $suffix = "")
 */
class ArrayUtils extends ArrayObject{
    /**
     * Creates a new, shallow-copied ArrayUtils instance from an array-like (array or array-object or iterable-object)
     *
     * @param array|ArrayObject|iterable $arrayLike
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/from
     */
    public static function from($arrayLike, ?callable $mapFn = null, ...$mapArgs) : ArrayUtils{
        $array = self::toArray($arrayLike);
        assert(is_array($array), "Argument must be of the type array-like, " . gettype($arrayLike) . " given");

        if($mapFn !== null){
            $array = array_map($mapArgs, $array, $mapArgs);
        }
        return new self($array);
    }

    /**
     * Creates a new, ArrayUtils instance from variadic function arguments
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/of
     */
    public static function of(...$elements) : ArrayUtils{
        return new self($elements);
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
    public static function __chunk(array $from, int $size, bool $preserveKeys = false){
        return array_chunk($from, $size, $preserveKeys);
    }

    /**
     * Return the values from a single column in the input array
     *
     * @see \array_column
     * @url https://www.php.net/manual/en/function.array-column.php
     */
    public static function __column(array $from, $column_key, $indexKey = null){
        return array_column($from, $column_key, $indexKey);
    }

    /**
     * Creates an array by using one array for keys and another for its values
     *
     * @param array|null $values If is null, Use self clone
     *
     * @see \array_combine
     * @url https://www.php.net/manual/en/function.array-column.php
     */
    public static function __combine(array $from, ?array $values = null){
        return array_combine($from, $values ?? $from);
    }

    /**
     * Merge one or more arrays
     *
     * @see \array_merge
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/concat
     */
    public static function __concat(array ...$values){
        return array_merge(...self::__map($values, function($value){ return is_array($value) ? $value : [$value]; }));
    }

    /** All similar to @see __concat(), but not overwrite existing keys */
    public static function __concatSoft(array ...$values){
        $array = [];
        foreach($values as $value){
            $array += $value;
        }
        return $array;
    }

    /**
     * Counts all the values of an array
     *
     * @see \array_count_values
     * @url https://www.php.net/manual/en/function.array-count-values.php
     */
    public static function __countValues(array $from){
        return array_count_values($from);
    }

    /**
     * Computes the difference of arrays
     *
     * @see \array_diff
     * @url https://www.php.net/manual/en/function.array-diff.php
     */
    public static function __diff(array $from, array ...$arrays){
        return array_diff($from, ...$arrays);
    }

    /**
     * All similar to @see __diff(), but this applies to both keys and values
     *
     * @see \array_diff_assoc
     * @url https://www.php.net/manual/en/function.array-diff-assoc.php
     */
    public static function __diffAssoc(array $from, array ...$arrays){
        return array_diff_assoc($from, ...$arrays);
    }

    /**
     * All similar to @see __diff(), but this applies to keys
     *
     * @see \array_diff_key
     * @url https://www.php.net/manual/en/function.array-diff-key.php
     */
    public static function __diffKey(array $from, array ...$arrays){
        return array_diff_key($from, ...$arrays);
    }

    /**
     * Tests whether all elements pass the $callback function
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/every
     */
    public static function _every(array $from, callable $callback) : bool{
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
    public static function __fill(array $from, $value, int $start = 0, int $end = null){
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
     * @see \array_fill_keys
     * @url https://www.php.net/manual/en/function.array-fill-keys.php
     */
    public static function __fillKeys(array $from, $value){
        return array_fill_keys($from, $value);
    }

    /**
     * Returns a new array with all elements that pass the $callback function
     *
     * @see \array_filter
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter
     */
    public static function __filter(array $from, callable $callback, int $flag = 0){
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
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/find
     */
    public static function _find(array $from, callable $callback){
        foreach($from as $key => $value){
            if($callback($value, $key, $from))
                return $value;
        }
        return null;
    }

    /**
     * Returns the key of the first element that that pass the $callback function
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/findIndex
     */
    public static function _findIndex(array $from, callable $callback){
        foreach($from as $key => $value){
            if($callback($value, $key, $from))
                return $key;
        }
        return null;
    }

    /** Returns the value at the result of @see _keyFirst() */
    public static function _first(array $from){
        return $from[self::_keyFirst($from)];
    }

    /**
     * Returns a new array with all sub-array elements concatenated into it recursively up to the specified depth
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/flat
     */
    public static function __flat(array $from, int $dept = 1){
        if($dept > 0) return [$from];
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
    public static function __flatMap(array $from, callable $callback){
        return self::__concat(...self::__map($from, $callback));
    }

    /**
     * Exchanges all keys with their associated values in an array
     *
     * @see \array_flip
     * @url https://www.php.net/manual/en/function.array-flip.php
     */
    public static function __flip(array $from){
        return array_flip($from);
    }

    /**
     * Executes a $callback function once for each array element.
     *
     * @see foreach
     * @url https://www.php.net/manual/en/function.array-map.php
     */
    public static function __forEach(array $from, callable $callback){
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
    public static function _includes(array $from, $needle, int $start = 0) : bool{
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
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf
     */
    public static function _indexOf(array $from, $needle, int $start = 0){
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
    public static function __intersect(array $from, array ...$arrays){
        return array_intersect($from, ...$arrays);
    }

    /**
     * All similar to @see __intersect(), but this applies to both keys and values
     *
     * @see \array_intersect_assoc
     * @url https://www.php.net/manual/en/function.array-intersect-assoc.php
     */
    public static function __intersectAssoc(array $from, array ...$arrays){
        return array_intersect_assoc($from, ...$arrays);
    }

    /**
     * All similar to @see __intersect(), but this applies to keys
     *
     * @see \array_intersect_key
     * @url https://www.php.net/manual/en/function.array-intersect-key.php
     */
    public static function __intersectkey(array $from, array ...$arrays){
        return array_intersect_key($from, ...$arrays);
    }

    /**
     * Join array elements with a string. You can specify a suffix and prefix
     *
     * @see \implode
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/join
     */
    public static function _join(array $from, string $glue = ",", string $prefix = "", string $suffix = "") : string{
        return $prefix . implode($glue, $from) . $suffix;
    }

    /** Alias of @see offsetExists() */
    public static function _keyExists(array $from, $key) : bool{
        return isset($from[$key]);
    }

    /**
     * Gets the first key of an array
     *
     * @see \array_key_first
     * @url https://www.php.net/manual/en/function.array-key-first.php
     */
    public static function _keyFirst(array $from){
        return array_keys($from)[0] ?? null;
    }

    /**
     * Gets the last key of an array
     *
     * @see \array_key_last
     * @url https://www.php.net/manual/en/function.array-key-last.php
     */
    public static function _keyLast(array $from){
        return array_keys($from)[count($from) - 1] ?? null;
    }

    /**
     * Gets the random key of an array
     *
     * @return mixed
     * @see \array_rand
     * @url https://www.php.net/manual/en/function.array-rand.php
     */
    public static function _keyRandom(array $from){
        return ($keys = array_keys($from))[rand(0, count($keys) - 1)] ?? null;
    }

    /**
     * Return all the keys of an array
     *
     * @see \array_keys
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/keys
     */
    public static function __keys(array $from){
        return array_keys($from);
    }

    /** Returns the value at the result of @see _keyLast() */
    public static function _last(array $from){
        return $from[self::_keyLast($from)];
    }

    /**
     * Applies the callback to the values of the given arrays
     *
     * @see \array_map
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/map
     */
    public static function __map(array $from, callable $callback){
        $array = [];
        foreach($from as $key => $value){
            $array[$key] = $callback($value, $key, $from);
        }
        return $array;
    }

    /** All similar to @see __map(), but this applies to both keys and values */
    public static function __mapAssoc(array $from, callable $callback){
        $array = [];
        foreach($from as $key => $value){
            [$newKey, $newValue] = $callback($value, $key, $from);
            $array[$newKey] = $newValue;
        }
        return $array;
    }

    /** All similar to @see __map(), but this applies to keys */
    public static function __mapKey(array $from, callable $callback){
        $array = [];
        foreach($from as $key => $value){
            $array[$callback($value, $key, $from)] = $value;
        }
        return $array;
    }

    /** Alias of @see __concat() */
    public static function __merge(array ...$values){
        return self::__concat(...$values);
    }

    /** Alias of @see __concatSoft() */
    public static function __mergeSoft(array ...$values){
        return self::__concatSoft(...$values);
    }

    /**
     * Pad array to the specified length with a value
     *
     * @see \array_pad
     * @url https://www.php.net/manual/en/function.array-pad.php
     */
    public static function __pad(array $from, int $size, $value){
        return array_pad($from, $size, $value);
    }

    /**
     * Removes the last element and returns that element
     *
     * @see \array_pop
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/pop
     */
    public static function _pop(array &$from){
        return array_pop($from);
    }

    /**
     * Push elements onto the end of array
     *
     * @see \array_push
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/push
     */
    public static function __push(array $from, ...$values){
        array_push($from, ...$values);
        return $from;
    }

    /** Returns the value at the result of @see _keyRandom() */
    public static function _random(array $from){
        return $from[self::_keyRandom($from)];
    }

    /**
     * Executes a reducer function on each element of the array, resulting in single output value
     *
     * @see \array_reduce
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reduce
     */
    public static function _reduce(array $from, callable $callback, $initialValue = null){
        $currentValue = $initialValue;
        foreach($from as $key => $value){
            $currentValue = $callback($currentValue, $value, $key, $from);
        }
        return $currentValue;
    }

    /** All similar to @see _reduce(), but reverse order */
    public static function _reduceRight(array $from, callable $callback, $initialValue = null){
        $currentValue = $initialValue;
        foreach($from as $key => $value){
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
    public static function __replace(array $from, array ...$arrays){
        return array_replace_recursive($from, ...$arrays);
    }

    /**
     * Return an array with elements in reverse order
     *
     * @see \array_reverse
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reverse
     */
    public static function __reverse(array $from, bool $preserveKeys = false) : array{
        return array_reverse($from, $preserveKeys);
    }

    /** Alias of @see _indexOf() */
    public static function _search(array $from, $needle, int $start = 0){
        return self::_indexOf($from, $needle, $start);
    }

    /**
     * Removes the first element and returns that element
     *
     * @see \array_shift
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/shift
     */
    public static function _shift(array &$from){
        return array_shift($from);
    }

    /**
     * Return an array with selected from start to end
     * Extract a slice of the array
     *
     * @see \array_slice
     * @url https://www.php.net/manual/en/function.array-slice.php
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/slice
     */
    public static function __slice(array $from, int $start = 0, int $end = null, $preserve_keys = false){
        $array = [];
        $keys = array_keys($from);
        $values = array_values($from);
        $count = count($from);
        $end = $end ?? $count;

        $i = $start < 0 ? max($count + $start, 0) : min($start, $count);
        $max = $end < 0 ? max($count + $end, 0) : min($end, $count);
        for(; $i < $max; ++$i){
            if($preserve_keys){
                $from[$keys[$i]] = $values[$i];
            }else{
                $from[] = $values[$i];
            }
        }

        return $array;
    }

    /**
     * Tests whether least one element pass the $callback function
     *
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/some
     */
    public static function _some(array $from, callable $callback) : bool{
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
    public static function __sort(array $from, ?callable $callback = null){
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
    public static function __sortKey(array $from, ?callable $callback = null){
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
    public static function __splice(array $from, int $offset, ?int $length = null, ...$replacement){
        return array_splice($array, $offset, $length ?? count($from), $replacement);
    }

    /**
     * Calculate the sum of values in an array
     *
     * @return int|float
     * @see \array_sum
     * @url https://www.php.net/manual/en/function.array-sum.php
     */
    public static function _sum(array $from){
        return array_sum($from);
    }

    /**
     * Removes duplicate values from an array
     *
     * @see \array_unique
     * @url https://www.php.net/manual/en/function.array-unique.php
     */
    public static function __unique(array $from, int $sort_flags = SORT_STRING){
        return array_unique($from, $sort_flags);
    }

    /**
     * Push elements onto the start of array
     *
     * @see \array_unshift
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/unshift
     */
    public static function __unshift(array $from, ...$values){
        array_unshift($from, ...$values);
        return $from;
    }

    /**
     * Return all the values of an array
     *
     * @see \array_values
     * @url https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/values
     */
    public static function __values(array $from){
        return array_values($from);
    }

    /** @throws \BadMethodCallException */
    public function __call(string $name, array $arguments){
        if($raw = substr($name, -2) === "As"){
            $name = substr($name, 0, -2);
        }
        $arguments = self::__map($arguments, function($value){ return self::toArray($value) ?? $value; });

        if(method_exists(self::class, $method = "__$name")){
            //Mapping method calls omitting "__" (It is meaning result is array)
            $result = self::$method($this->getArrayCopy(), ...$arguments);
            return $raw || !is_array($result) ? $result : $this->exchange($result);
        }elseif(method_exists(self::class, $method = "_$name")){
            //Mapping method calls omitting "_" (It is meaning result is not array)
            $array = $this->getArrayCopy();
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

    /**
     * Returns the array get from array-like (array or array-object or iterable-object)
     * if it failed, returns null
     *
     * @param array|ArrayObject|iterable $arrayLike
     */
    private static function toArray($arrayLike) : ?array{
        if(is_array($arrayLike)){
            return $arrayLike;
        }elseif($arrayLike instanceof ArrayObject){
            return $arrayLike->getArrayCopy();
        }elseif($arrayLike instanceof iterable){
            $array = [];
            foreach($arrayLike as $key => $value){
                $array[$key] = $value;
            }
            return $array;
        }else{
            return null;
        }
    }
}