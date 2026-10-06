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
use Exception;
use function array_keys;
use function array_search;
use function array_slice;
use function array_values;
use function count;
use function end;
use function in_array;
use function key;
use function max;
use function min;
use function random_int;

/**
 * Methods that look up a single element or key (includes, indexOf, find, first, last, random)
 *
 * Requires ArrayUtils::mapToArray() and ArrayUtils::exchange() of the class using this trait
 */
trait SearchTrait{
    /**
     * Tests whether an array includes a $needle
     *
     * @link https://arrayutils.docs.present.kim/methods/g/includes
     */
    public function includes($needle, int $start = 0) : bool{
        return self::includesFrom($this->getArrayCopy(), $needle, $start);
    }

    /**
     * Same as includes(), but operates on the given iterable
     */
    public static function includesFrom(iterable $from, $needle, int $start = 0) : bool{
        $array = (array) $from;
        if($start !== 0){
            $count = count($array);
            $array = array_slice($array, $start < 0 ? max($count + $start, 0) : min($start, $count), null, true);
        }
        return in_array($needle, $array, true);
    }

    /**
     * Returns the first index at which a given element can be found in the array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/index-of
     */
    public function indexOf($needle, int $start = 0){
        return self::indexOfFrom($this->getArrayCopy(), $needle, $start);
    }

    /**
     * Same as indexOf(), but operates on the given iterable
     *
     * @return int|string|null
     */
    public static function indexOfFrom(iterable $from, $needle, int $start = 0){
        $array = (array) $from;
        if($start !== 0){
            $count = count($array);
            $array = array_slice($array, $start < 0 ? max($count + $start, 0) : min($start, $count), null, true);
        }
        $key = array_search($needle, $array, true);
        return $key === false ? null : $key;
    }

    /**
     * Alias of indexOf()
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/index-of
     */
    public function search($needle, int $start = 0){
        return self::searchFrom($this->getArrayCopy(), $needle, $start);
    }

    /**
     * Same as search(), but operates on the given iterable
     *
     * @return int|string|null
     */
    public static function searchFrom(iterable $from, $needle, int $start = 0){
        $array = (array) $from;
        return self::indexOfFrom($array, $needle, $start);
    }

    /**
     * Tests whether the $key exists in the array and its value is not null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/key-exists
     */
    public function keyExists($key) : bool{
        return self::keyExistsFrom($this->getArrayCopy(), $key);
    }

    /**
     * Same as keyExists(), but operates on the given iterable
     */
    public static function keyExistsFrom(iterable $from, $key) : bool{
        $array = (array) $from;
        return isset($array[$key]);
    }

    /**
     * Returns the value of the first element that that pass the $callback function
     *
     * @link https://arrayutils.docs.present.kim/methods/g/find
     */
    public function find(callable $callback){
        return self::findFrom($this->getArrayCopy(), $callback);
    }

    /**
     * Same as find(), but operates on the given iterable
     */
    public static function findFrom(iterable $from, callable $callback){
        $array = (array) $from;
        foreach($array as $key => $value){
            if($callback($value, $key, $array)){
                return $value;
            }
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
    public function findIndex(callable $callback){
        return self::findIndexFrom($this->getArrayCopy(), $callback);
    }

    /**
     * Same as findIndex(), but operates on the given iterable
     *
     * @return int|string|null
     */
    public static function findIndexFrom(iterable $from, callable $callback){
        $array = (array) $from;
        foreach($array as $key => $value){
            if($callback($value, $key, $array)){
                return $key;
            }
        }
        return null;
    }

    /**
     * Returns the first value of an array, or null if it is empty
     *
     * @link https://arrayutils.docs.present.kim/methods/g/first
     */
    public function first(){
        return self::firstFrom($this->getArrayCopy());
    }

    /**
     * Same as first(), but operates on the given iterable
     */
    public static function firstFrom(iterable $from){
        $array = (array) $from;
        foreach($array as $value){
            return $value;
        }
        return null;
    }

    /**
     * Gets the first key of an array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/first/key
     */
    public function keyFirst(){
        return self::keyFirstFrom($this->getArrayCopy());
    }

    /**
     * Same as keyFirst(), but operates on the given iterable
     *
     * @return int|string|null
     */
    public static function keyFirstFrom(iterable $from){
        $array = (array) $from;
        foreach($array as $key => $_){
            return $key;
        }
        return null;
    }

    /**
     * Returns the last value of an array, or null if it is empty
     *
     * @link https://arrayutils.docs.present.kim/methods/g/last
     */
    public function last(){
        return self::lastFrom($this->getArrayCopy());
    }

    /**
     * Same as last(), but operates on the given iterable
     */
    public static function lastFrom(iterable $from){
        $array = (array) $from;
        return $array ? end($array) : null;
    }

    /**
     * Gets the last key of an array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/last/key
     */
    public function keyLast(){
        return self::keyLastFrom($this->getArrayCopy());
    }

    /**
     * Same as keyLast(), but operates on the given iterable
     *
     * @return int|string|null
     */
    public static function keyLastFrom(iterable $from){
        $array = (array) $from;
        if(!$array){
            return null;
        }
        end($array);
        return key($array);
    }

    /**
     * Returns the random value of an array, or null if it is empty
     *
     * @link https://arrayutils.docs.present.kim/methods/g/random
     */
    public function random(){
        return self::randomFrom($this->getArrayCopy());
    }

    /**
     * Same as random(), but operates on the given iterable
     */
    public static function randomFrom(iterable $from){
        $array = (array) $from;
        $count = count($array);
        if($count === 0){
            return null;
        }
        try{
            $index = random_int(0, $count - 1);
        }catch(Exception $_){
            return null;
        }
        return array_values($array)[$index];
    }

    /**
     * Gets the random key of an array
     *
     * @return int|string|null
     *
     * @link https://arrayutils.docs.present.kim/methods/g/random/key
     */
    public function keyRandom(){
        return self::keyRandomFrom($this->getArrayCopy());
    }

    /**
     * Same as keyRandom(), but operates on the given iterable
     *
     * @return int|string|null
     */
    public static function keyRandomFrom(iterable $from){
        $array = (array) $from;
        $count = count($array);
        if($count === 0){
            return null;
        }
        try{
            $index = random_int(0, $count - 1);
        }catch(Exception $_){
            return null;
        }
        return array_keys($array)[$index];
    }
}
