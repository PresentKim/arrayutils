<?php

/**
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
 *
 * @noinspection PhpUnused
 * @noinspection PhpDocSignatureIsNotCompleteInspection
 */

declare(strict_types=1);

namespace kim\present\lib\arrayutils\traits;

use kim\present\lib\arrayutils\ArrayUtils;
use function array_chunk;
use function array_column;
use function array_combine;
use function array_fill_keys;
use function array_flip;
use function array_keys;
use function array_pad;
use function array_slice;
use function array_values;
use function count;
use function implode;
use function max;
use function min;

/**
 * Methods that change the shape of the array (chunk, column, combine, fill, flip, keys, values, pad, slice, join)
 *
 * Requires ArrayUtils::mapToArray() and ArrayUtils::exchange() of the class using this trait
 */
trait ShapeTrait{
    /**
     * Split an array into chunks
     *
     * @link https://arrayutils.docs.present.kim/methods/c/chunk
     */
    public function chunk(int $size, bool $preserveKeys = false) : ArrayUtils{
        return $this->exchange(array_chunk($this->getArrayCopy(), $size, $preserveKeys));
    }

    /**
     * Same as chunk(), but returns a plain array and leaves the instance unchanged
     */
    public function chunkAs(int $size, bool $preserveKeys = false) : array{
        return array_chunk($this->getArrayCopy(), $size, $preserveKeys);
    }

    /**
     * Same as chunk(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function chunkFrom(iterable $from, int $size, bool $preserveKeys = false) : ArrayUtils{
        return new self(array_chunk((array) $from, $size, $preserveKeys));
    }

    /**
     * Same as chunkFrom(), but returns a plain array
     */
    public static function chunkFromAs(iterable $from, int $size, bool $preserveKeys = false) : array{
        return array_chunk((array) $from, $size, $preserveKeys);
    }

    /**
     * Returns the values from a single column in the input array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/column
     */
    public function column($valueKey, $indexKey = null) : ArrayUtils{
        return $this->exchange(array_column($this->getArrayCopy(), $valueKey, $indexKey));
    }

    /**
     * Same as column(), but returns a plain array and leaves the instance unchanged
     */
    public function columnAs($valueKey, $indexKey = null) : array{
        return array_column($this->getArrayCopy(), $valueKey, $indexKey);
    }

    /**
     * Same as column(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function columnFrom(iterable $from, $valueKey, $indexKey = null) : ArrayUtils{
        return new self(array_column((array) $from, $valueKey, $indexKey));
    }

    /**
     * Same as columnFrom(), but returns a plain array
     */
    public static function columnFromAs(iterable $from, $valueKey, $indexKey = null) : array{
        return array_column((array) $from, $valueKey, $indexKey);
    }

    /**
     * Creates an array by using one array for keys and another for its values
     * If $valueArray is null, uses the array itself
     *
     * @link https://arrayutils.docs.present.kim/methods/c/combine
     */
    public function combine(?iterable $valueArray = null) : ArrayUtils{
        $a = $this->getArrayCopy();
        return $this->exchange(array_combine($a, (array) ($valueArray ?? $a)));
    }

    /**
     * Same as combine(), but returns a plain array and leaves the instance unchanged
     */
    public function combineAs(?iterable $valueArray = null) : array{
        $a = $this->getArrayCopy();
        return array_combine($a, (array) ($valueArray ?? $a));
    }

    /**
     * Same as combine(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function combineFrom(iterable $from, ?iterable $valueArray = null) : ArrayUtils{
        $a = (array) $from;
        return new self(array_combine($a, (array) ($valueArray ?? $a)));
    }

    /**
     * Same as combineFrom(), but returns a plain array
     */
    public static function combineFromAs(iterable $from, ?iterable $valueArray = null) : array{
        $a = (array) $from;
        return array_combine($a, (array) ($valueArray ?? $a));
    }

    /**
     * Changes all elements in an array to a provided value, from a start index to an end index
     *
     * @link https://arrayutils.docs.present.kim/methods/c/fill
     */
    public function fill($value, int $start = 0, ?int $end = null) : ArrayUtils{
        return $this->exchange(self::fillFromAs($this->getArrayCopy(), $value, $start, $end));
    }

    /**
     * Same as fill(), but returns a plain array and leaves the instance unchanged
     */
    public function fillAs($value, int $start = 0, ?int $end = null) : array{
        return self::fillFromAs($this->getArrayCopy(), $value, $start, $end);
    }

    /**
     * Same as fill(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function fillFrom(iterable $from, $value, int $start = 0, ?int $end = null) : ArrayUtils{
        return new self(self::fillFromAs($from, $value, $start, $end));
    }

    /**
     * Same as fillFrom(), but returns a plain array
     */
    public static function fillFromAs(iterable $from, $value, int $start = 0, ?int $end = null) : array{
        $array = (array) $from;
        $keys = array_keys($array);
        [$i, $max] = self::resolveRange(count($keys), $start, $end ?? PHP_INT_MAX);
        for(; $i < $max; ++$i){
            $array[$keys[$i]] = $value;
        }
        return $array;
    }

    /**
     * Fill an array with values, specifying keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/fill/keys
     */
    public function fillKeys($value) : ArrayUtils{
        return $this->exchange(array_fill_keys($this->getArrayCopy(), $value));
    }

    /**
     * Same as fillKeys(), but returns a plain array and leaves the instance unchanged
     */
    public function fillKeysAs($value) : array{
        return array_fill_keys($this->getArrayCopy(), $value);
    }

    /**
     * Same as fillKeys(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function fillKeysFrom(iterable $from, $value) : ArrayUtils{
        return new self(array_fill_keys((array) $from, $value));
    }

    /**
     * Same as fillKeysFrom(), but returns a plain array
     */
    public static function fillKeysFromAs(iterable $from, $value) : array{
        return array_fill_keys((array) $from, $value);
    }

    /**
     * Exchanges all keys with their associated values in an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/flip
     */
    public function flip() : ArrayUtils{
        return $this->exchange(array_flip($this->getArrayCopy()));
    }

    /**
     * Same as flip(), but returns a plain array and leaves the instance unchanged
     */
    public function flipAs() : array{
        return array_flip($this->getArrayCopy());
    }

    /**
     * Same as flip(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function flipFrom(iterable $from) : ArrayUtils{
        return new self(array_flip((array) $from));
    }

    /**
     * Same as flipFrom(), but returns a plain array
     */
    public static function flipFromAs(iterable $from) : array{
        return array_flip((array) $from);
    }

    /**
     * Returns all the keys of an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/keys
     */
    public function keys() : ArrayUtils{
        return $this->exchange(array_keys($this->getArrayCopy()));
    }

    /**
     * Same as keys(), but returns a plain array and leaves the instance unchanged
     */
    public function keysAs() : array{
        return array_keys($this->getArrayCopy());
    }

    /**
     * Same as keys(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function keysFrom(iterable $from) : ArrayUtils{
        return new self(array_keys((array) $from));
    }

    /**
     * Same as keysFrom(), but returns a plain array
     */
    public static function keysFromAs(iterable $from) : array{
        return array_keys((array) $from);
    }

    /**
     * Returns all the values of an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/values
     */
    public function values() : ArrayUtils{
        return $this->exchange(array_values($this->getArrayCopy()));
    }

    /**
     * Same as values(), but returns a plain array and leaves the instance unchanged
     */
    public function valuesAs() : array{
        return array_values($this->getArrayCopy());
    }

    /**
     * Same as values(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function valuesFrom(iterable $from) : ArrayUtils{
        return new self(array_values((array) $from));
    }

    /**
     * Same as valuesFrom(), but returns a plain array
     */
    public static function valuesFromAs(iterable $from) : array{
        return array_values((array) $from);
    }

    /**
     * Pad array to the specified length with a value
     *
     * @link https://arrayutils.docs.present.kim/methods/c/pad
     */
    public function pad(int $size, $value) : ArrayUtils{
        return $this->exchange(array_pad($this->getArrayCopy(), $size, $value));
    }

    /**
     * Same as pad(), but returns a plain array and leaves the instance unchanged
     */
    public function padAs(int $size, $value) : array{
        return array_pad($this->getArrayCopy(), $size, $value);
    }

    /**
     * Same as pad(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function padFrom(iterable $from, int $size, $value) : ArrayUtils{
        return new self(array_pad((array) $from, $size, $value));
    }

    /**
     * Same as padFrom(), but returns a plain array
     */
    public static function padFromAs(iterable $from, int $size, $value) : array{
        return array_pad((array) $from, $size, $value);
    }

    /**
     * Returns an array with selected from start to end
     * Extract a slice of the array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/slice
     */
    public function slice(int $start = 0, ?int $end = null, bool $preserveKeys = false) : ArrayUtils{
        return $this->exchange(self::sliceFromAs($this->getArrayCopy(), $start, $end, $preserveKeys));
    }

    /**
     * Same as slice(), but returns a plain array and leaves the instance unchanged
     */
    public function sliceAs(int $start = 0, ?int $end = null, bool $preserveKeys = false) : array{
        return self::sliceFromAs($this->getArrayCopy(), $start, $end, $preserveKeys);
    }

    /**
     * Same as slice(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function sliceFrom(iterable $from, int $start = 0, ?int $end = null, bool $preserveKeys = false) : ArrayUtils{
        return new self(self::sliceFromAs($from, $start, $end, $preserveKeys));
    }

    /**
     * Same as sliceFrom(), but returns a plain array
     */
    public static function sliceFromAs(iterable $from, int $start = 0, ?int $end = null, bool $preserveKeys = false) : array{
        $array = (array) $from;
        [$i, $max] = self::resolveRange(count($array), $start, $end ?? PHP_INT_MAX);
        if($max <= $i){
            return [];
        }
        $result = array_slice($array, $i, $max - $i, true);
        return $preserveKeys ? $result : array_values($result);
    }

    /**
     * Join array elements with a string. You can specify a suffix and prefix
     *
     * @link https://arrayutils.docs.present.kim/methods/g/join
     */
    public function join(string $glue = ",", string $prefix = "", string $suffix = "") : string{
        return $prefix . implode($glue, $this->getArrayCopy()) . $suffix;
    }

    /**
     * Same as join(), but operates on the given iterable
     */
    public static function joinFrom(iterable $from, string $glue = ",", string $prefix = "", string $suffix = "") : string{
        return $prefix . implode($glue, (array) $from) . $suffix;
    }

    /**
     * Converts the $start and $end indexes (negative values count from the end) to an offset range of $count elements
     *
     * @return int[] [first index, last index + 1]
     */
    private static function resolveRange(int $count, int $start, int $end) : array{
        return [
            $start < 0 ? max($count + $start, 0) : min($start, $count),
            $end < 0 ? max($count + $end, 0) : min($end, $count)
        ];
    }
}
