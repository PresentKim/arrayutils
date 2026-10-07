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
use function array_reverse;
use function array_sum;
use function is_array;

/**
 * Methods that walk every element with a callback (map, filter, forEach, reduce, every, some)
 *
 * Requires ArrayUtils::toArray() and ArrayUtils::mapToArray() of the class using this trait
 */
trait IterationTrait{
    /**
     * Applies the callback to the values of the given arrays
     *
     * @link https://arrayutils.docs.present.kim/methods/c/map
     */
    public function map(callable $callback) : ArrayUtils{
        $this->exchangeArray(self::mapFromAs($this->getArrayCopy(), $callback));
        return $this;
    }

    /**
     * Same as map(), but returns a plain array and leaves the instance unchanged
     */
    public function mapAs(callable $callback) : array{
        return self::mapFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as map(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function mapFrom(iterable $from, callable $callback) : ArrayUtils{
        return new self(self::mapFromAs($from, $callback));
    }

    /**
     * Same as mapFrom(), but returns a plain array
     */
    public static function mapFromAs(iterable $from, callable $callback) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        $result = [];
        foreach($array as $key => $value){
            $result[$key] = $callback($value, $key, $array);
        }
        return $result;
    }

    /**
     * All similar to map(), but this applies to both keys and values
     *
     * @link https://arrayutils.docs.present.kim/methods/c/map/assoc
     */
    public function mapAssoc(callable $callback) : ArrayUtils{
        $this->exchangeArray(self::mapAssocFromAs($this->getArrayCopy(), $callback));
        return $this;
    }

    /**
     * Same as mapAssoc(), but returns a plain array and leaves the instance unchanged
     */
    public function mapAssocAs(callable $callback) : array{
        return self::mapAssocFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as mapAssoc(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function mapAssocFrom(iterable $from, callable $callback) : ArrayUtils{
        return new self(self::mapAssocFromAs($from, $callback));
    }

    /**
     * Same as mapAssocFrom(), but returns a plain array
     */
    public static function mapAssocFromAs(iterable $from, callable $callback) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        $result = [];
        foreach($array as $key => $value){
            [$newKey, $newValue] = $callback($value, $key, $array);
            $result[$newKey] = $newValue;
        }
        return $result;
    }

    /**
     * All similar to map(), but this applies to keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/map/key
     */
    public function mapKey(callable $callback) : ArrayUtils{
        $this->exchangeArray(self::mapKeyFromAs($this->getArrayCopy(), $callback));
        return $this;
    }

    /**
     * Same as mapKey(), but returns a plain array and leaves the instance unchanged
     */
    public function mapKeyAs(callable $callback) : array{
        return self::mapKeyFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as mapKey(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function mapKeyFrom(iterable $from, callable $callback) : ArrayUtils{
        return new self(self::mapKeyFromAs($from, $callback));
    }

    /**
     * Same as mapKeyFrom(), but returns a plain array
     */
    public static function mapKeyFromAs(iterable $from, callable $callback) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        $result = [];
        foreach($array as $key => $value){
            $result[$callback($value, $key, $array)] = $value;
        }
        return $result;
    }

    /**
     * Returns a new array with all elements that pass the $callback function
     *
     * @link https://arrayutils.docs.present.kim/methods/c/filter
     */
    public function filter(callable $callback) : ArrayUtils{
        $this->exchangeArray(self::filterFromAs($this->getArrayCopy(), $callback));
        return $this;
    }

    /**
     * Same as filter(), but returns a plain array and leaves the instance unchanged
     */
    public function filterAs(callable $callback) : array{
        return self::filterFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as filter(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function filterFrom(iterable $from, callable $callback) : ArrayUtils{
        return new self(self::filterFromAs($from, $callback));
    }

    /**
     * Same as filterFrom(), but returns a plain array
     */
    public static function filterFromAs(iterable $from, callable $callback) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        $result = [];
        foreach($array as $key => $value){
            if($callback($value, $key, $array)){
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * Executes a $callback function once for each array element
     *
     * @link https://arrayutils.docs.present.kim/methods/c/for-each
     */
    public function forEach(callable $callback) : ArrayUtils{
        $this->exchangeArray(self::forEachFromAs($this->getArrayCopy(), $callback));
        return $this;
    }

    /**
     * Same as forEach(), but returns a plain array and leaves the instance unchanged
     */
    public function forEachAs(callable $callback) : array{
        return self::forEachFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as forEach(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function forEachFrom(iterable $from, callable $callback) : ArrayUtils{
        return new self(self::forEachFromAs($from, $callback));
    }

    /**
     * Same as forEachFrom(), but returns a plain array
     */
    public static function forEachFromAs(iterable $from, callable $callback) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        foreach($array as $key => $value){
            $callback($value, $key, $array);
        }
        return $array;
    }

    /**
     * Tests whether all elements pass the $callback function
     *
     * @link https://arrayutils.docs.present.kim/methods/g/every
     */
    public function every(callable $callback) : bool{
        return self::everyFrom($this->getArrayCopy(), $callback);
    }

    /**
     * Same as every(), but operates on the given iterable
     */
    public static function everyFrom(iterable $from, callable $callback) : bool{
        $array = is_array($from) ? $from : self::toArray($from);
        foreach($array as $key => $value){
            if(!$callback($value, $key, $array)){
                return false;
            }
        }
        return true;
    }

    /**
     * Tests whether least one element pass the $callback function
     *
     * @link https://arrayutils.docs.present.kim/methods/g/some
     */
    public function some(callable $callback) : bool{
        return self::someFrom($this->getArrayCopy(), $callback);
    }

    /**
     * Same as some(), but operates on the given iterable
     */
    public static function someFrom(iterable $from, callable $callback) : bool{
        $array = is_array($from) ? $from : self::toArray($from);
        foreach($array as $key => $value){
            if($callback($value, $key, $array)){
                return true;
            }
        }
        return false;
    }

    /**
     * Executes a reducer function on each element of the array, resulting in single output value
     *
     * @link https://arrayutils.docs.present.kim/methods/g/reduce
     */
    public function reduce(callable $callback, $initialValue = null){
        return self::reduceFrom($this->getArrayCopy(), $callback, $initialValue);
    }

    /**
     * Same as reduce(), but operates on the given iterable
     */
    public static function reduceFrom(iterable $from, callable $callback, $initialValue = null){
        $array = is_array($from) ? $from : self::toArray($from);
        $currentValue = $initialValue;
        foreach($array as $key => $value){
            $currentValue = $callback($currentValue, $value, $key, $array);
        }
        return $currentValue;
    }

    /**
     * All similar to reduce(), but reverse order
     *
     * @link https://arrayutils.docs.present.kim/methods/g/reduce/right
     */
    public function reduceRight(callable $callback, $initialValue = null){
        return self::reduceRightFrom($this->getArrayCopy(), $callback, $initialValue);
    }

    /**
     * Same as reduceRight(), but operates on the given iterable
     */
    public static function reduceRightFrom(iterable $from, callable $callback, $initialValue = null){
        $array = is_array($from) ? $from : self::toArray($from);
        $currentValue = $initialValue;
        foreach(array_reverse($array, true) as $key => $value){
            $currentValue = $callback($currentValue, $value, $key, $array);
        }
        return $currentValue;
    }

    /**
     * Calculate the sum of values in an array
     *
     * @return int|float
     *
     * @link https://arrayutils.docs.present.kim/methods/g/sum
     */
    public function sum(){
        return array_sum($this->getArrayCopy());
    }

    /**
     * Same as sum(), but operates on the given iterable
     *
     * @return int|float
     */
    public static function sumFrom(iterable $from){
        return array_sum((is_array($from) ? $from : self::toArray($from)));
    }
}
