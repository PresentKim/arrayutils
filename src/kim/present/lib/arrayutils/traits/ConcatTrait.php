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
use function array_merge;
use function array_replace_recursive;
use function is_array;

/**
 * Methods that join arrays together (concat, merge, replace, flat)
 *
 * Requires ArrayUtils::mapToArray() and ArrayUtils::exchange() of the class using this trait
 */
trait ConcatTrait{
    /**
     * Merge one or more arrays
     *
     * @link https://arrayutils.docs.present.kim/methods/c/concat
     */
    public function concat(...$values) : ArrayUtils{
        return $this->exchange(array_merge($this->getArrayCopy(), ...self::mapToArray($values)));
    }

    /**
     * Same as concat(), but returns a plain array and leaves the instance unchanged
     */
    public function concatAs(...$values) : array{
        return array_merge($this->getArrayCopy(), ...self::mapToArray($values));
    }

    /**
     * Same as concat(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function concatFrom(iterable $from, ...$values) : ArrayUtils{
        return new self(array_merge((array) $from, ...self::mapToArray($values)));
    }

    /**
     * Same as concatFrom(), but returns a plain array
     */
    public static function concatFromAs(iterable $from, ...$values) : array{
        return array_merge((array) $from, ...self::mapToArray($values));
    }

    /**
     * All similar to concat(), but not overwrite existing keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/concat/soft
     */
    public function concatSoft(...$values) : ArrayUtils{
        return $this->exchange(self::concatSoftFromAs($this->getArrayCopy(), ...$values));
    }

    /**
     * Same as concatSoft(), but returns a plain array and leaves the instance unchanged
     */
    public function concatSoftAs(...$values) : array{
        return self::concatSoftFromAs($this->getArrayCopy(), ...$values);
    }

    /**
     * Same as concatSoft(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function concatSoftFrom(iterable $from, ...$values) : ArrayUtils{
        return new self(self::concatSoftFromAs($from, ...$values));
    }

    /**
     * Same as concatSoftFrom(), but returns a plain array
     */
    public static function concatSoftFromAs(iterable $from, ...$values) : array{
        $array = (array) $from;
        foreach($values as $value){
            $array += (array) $value;
        }
        return $array;
    }

    /**
     * Alias of concat()
     *
     * @link https://arrayutils.docs.present.kim/methods/c/concat
     */
    public function merge(...$values) : ArrayUtils{
        return $this->exchange(array_merge($this->getArrayCopy(), ...self::mapToArray($values)));
    }

    /**
     * Same as merge(), but returns a plain array and leaves the instance unchanged
     */
    public function mergeAs(...$values) : array{
        return array_merge($this->getArrayCopy(), ...self::mapToArray($values));
    }

    /**
     * Same as merge(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function mergeFrom(iterable $from, ...$values) : ArrayUtils{
        return new self(array_merge((array) $from, ...self::mapToArray($values)));
    }

    /**
     * Same as mergeFrom(), but returns a plain array
     */
    public static function mergeFromAs(iterable $from, ...$values) : array{
        return array_merge((array) $from, ...self::mapToArray($values));
    }

    /**
     * Alias of concatSoft()
     *
     * @link https://arrayutils.docs.present.kim/methods/c/concat/soft
     */
    public function mergeSoft(...$values) : ArrayUtils{
        return $this->exchange(self::mergeSoftFromAs($this->getArrayCopy(), ...$values));
    }

    /**
     * Same as mergeSoft(), but returns a plain array and leaves the instance unchanged
     */
    public function mergeSoftAs(...$values) : array{
        return self::mergeSoftFromAs($this->getArrayCopy(), ...$values);
    }

    /**
     * Same as mergeSoft(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function mergeSoftFrom(iterable $from, ...$values) : ArrayUtils{
        return new self(self::mergeSoftFromAs($from, ...$values));
    }

    /**
     * Same as mergeSoftFrom(), but returns a plain array
     */
    public static function mergeSoftFromAs(iterable $from, ...$values) : array{
        $array = (array) $from;
        return self::concatSoftFromAs($array, ...$values);
    }

    /**
     * Replaces elements from passed arrays into the first array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/replace
     */
    public function replace(iterable ...$iterables) : ArrayUtils{
        return $this->exchange(array_replace_recursive($this->getArrayCopy(), ...self::mapToArray($iterables)));
    }

    /**
     * Same as replace(), but returns a plain array and leaves the instance unchanged
     */
    public function replaceAs(iterable ...$iterables) : array{
        return array_replace_recursive($this->getArrayCopy(), ...self::mapToArray($iterables));
    }

    /**
     * Same as replace(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function replaceFrom(iterable $from, iterable ...$iterables) : ArrayUtils{
        return new self(array_replace_recursive((array) $from, ...self::mapToArray($iterables)));
    }

    /**
     * Same as replaceFrom(), but returns a plain array
     */
    public static function replaceFromAs(iterable $from, iterable ...$iterables) : array{
        return array_replace_recursive((array) $from, ...self::mapToArray($iterables));
    }

    /**
     * Returns a new array with all sub-array elements concatenated into it recursively up to the specified depth
     *
     * @link https://arrayutils.docs.present.kim/methods/c/flat
     */
    public function flat(int $dept = 1) : ArrayUtils{
        return $this->exchange(self::flatFromAs($this->getArrayCopy(), $dept));
    }

    /**
     * Same as flat(), but returns a plain array and leaves the instance unchanged
     */
    public function flatAs(int $dept = 1) : array{
        return self::flatFromAs($this->getArrayCopy(), $dept);
    }

    /**
     * Same as flat(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function flatFrom(iterable $from, int $dept = 1) : ArrayUtils{
        return new self(self::flatFromAs($from, $dept));
    }

    /**
     * Same as flatFrom(), but returns a plain array
     */
    public static function flatFromAs(iterable $from, int $dept = 1) : array{
        $array = (array) $from;
        if($dept <= 0){
            return $array;
        }
        $parts = [];
        foreach($array as $value){
            $parts[] = is_array($value) ? self::flatFromAs($value, $dept - 1) : (array) $value;
        }
        return $parts ? array_merge(...$parts) : [];
    }

    /**
     * Returns a new array formed by applying $callback function and then flattening the result by one level
     *
     * @link https://arrayutils.docs.present.kim/methods/c/flat/map
     */
    public function flatMap(callable $callback) : ArrayUtils{
        return $this->exchange(self::flatMapFromAs($this->getArrayCopy(), $callback));
    }

    /**
     * Same as flatMap(), but returns a plain array and leaves the instance unchanged
     */
    public function flatMapAs(callable $callback) : array{
        return self::flatMapFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as flatMap(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function flatMapFrom(iterable $from, callable $callback) : ArrayUtils{
        return new self(self::flatMapFromAs($from, $callback));
    }

    /**
     * Same as flatMapFrom(), but returns a plain array
     */
    public static function flatMapFromAs(iterable $from, callable $callback) : array{
        $array = (array) $from;
        $parts = [];
        foreach($array as $key => $value){
            $parts[] = (array) $callback($value, $key, $array);
        }
        return $parts ? array_merge(...$parts) : [];
    }
}
