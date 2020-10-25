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

use kim\present\utils\arrays\ArrayUtils as Arr;

/**
 * Mapping magic method calls omitting "__", returns original magic method's results
 * @method array toArray()
 * @method string toString()
 *
 * Mapping ~As method calls omitting "As", returns the result wrapped with ArrayBuilder
 * @method ArrayBuilder slice(int $offset, ?int $length = null, bool $preserveKeys = false)
 * @method ArrayBuilder map(callable $callable)
 * @method ArrayBuilder filter(callable $callable, int $flag = 0)
 * @method ArrayBuilder keys()
 * @method ArrayBuilder values()
 * @method ArrayBuilder combine()
 * @method ArrayBuilder merge(array|\ArrayObject $array)
 * @method ArrayBuilder mergeSoft(array|\ArrayObject $array)
 * @method ArrayBuilder mapAssoc(callable $callable)
 * @method ArrayBuilder keyMap(callable $callable)
 * @method ArrayBuilder flip()
 * @method ArrayBuilder diff(array|\ArrayObject $array)
 * @method ArrayBuilder diffKey(array|\ArrayObject $array)
 *
 * Mapping ~Key method calls omitting "Key", returns the value at that key
 * @method mixed first()
 * @method mixed last()
 * @method mixed random()
 *
 * Mapping array_function omitting "array_", returns array_function result, and save modified array to itself
 * @method mixed pop()
 * @method mixed shift()
 * @method int|float sum()
 */
class ArrayBuilder extends \ArrayObject{
    /** @param array|\ArrayObject $array */
    public function __construct($array, $flags = 0, $iteratorClass = "ArrayIterator"){
        parent::__construct(self::getArray($array), $flags, $iteratorClass);
    }

    /** @param array|\ArrayObject $array */
    public function exchangeTo($array) : ArrayBuilder{
        $this->exchangeArray(self::getArray($array));
        return $this;
    }

    public function join(string $glue = "", string $prefix = "", string $suffix = "") : string{
        return $prefix . implode($glue, $this->toArray()) . $suffix;
    }

    public function validate(callable $callable, bool $invertBreak = false) : bool{
        foreach($this->toArray() as $key => $value){
            if($callable($key, $value) === $invertBreak){
                return $invertBreak;
            }
        }
        return !$invertBreak;
    }

    public function firstKey(){
        return $this->keysAs()[0] ?? null;
    }

    public function lastKey(){
        return $this->keysAs()[$this->count() - 1] ?? null;
    }

    public function randomKey(){
        return ($keys = $this->keysAs())[rand(0, count($keys) - 1)] ?? null;
    }

    public function sliceAs(int $offset, ?int $length = null, bool $preserveKeys = false) : array{
        return array_slice($this->toArray(), $offset, $length, $preserveKeys);
    }

    public function mapAs(callable $callable) : array{
        return array_map($callable, $this->toArray());
    }

    public function filterAs(callable $callable, int $flag = 0) : array{
        return array_filter($this->toArray(), $callable, $flag);
    }

    public function keysAs() : array{
        return array_keys($this->toArray());
    }

    public function valuesAs() : array{
        return array_values($this->toArray());
    }

    public function combineAs() : array{
        return array_combine($array = $this->toArray(), $array);
    }

    /** @param array|\ArrayObject $array */
    public function mergeAs($array) : array{
        return array_merge_recursive($this->toArray(), self::getArray($array));
    }

    /** @param array|\ArrayObject $array */
    public function mergeSoftAs($array) : array{
        return array_merge_recursive($origin = $this->toArray(), array_diff_key(self::getArray($array), $origin));
    }

    public function mapAssocAs(callable $callable) : array{
        return array_column(array_map($callable, array_keys($array = $this->toArray()), $array), 1, 0);
    }

    public function keyMapAs(callable $callable) : array{
        return $this->mapAssocAs(function($_, $value) use ($callable){
            return [$callable($value), $value];
        });
    }

    public function flipAs() : array{
        return array_flip($this->toArray());
    }

    /** @param array|\ArrayObject $array */
    public function diffAs($array) : array{
        return array_diff($this->toArray(), self::getArray($array));
    }

    /** @param array|\ArrayObject $array */
    public function diffKeyAs($array) : array{
        return array_diff_key($this->toArray(), self::getArray($array));
    }

    public function __toArray() : array{
        return $this->getArrayCopy();
    }

    public function __toString() : string{
        return $this->join("");
    }

    /** @throws \Error */
    public function __call(string $name, array $arguments){
        //Mapping magic method calls omitting "__"
        if(method_exists($this, $magicMethod = "__" . $name))
            return $this->$magicMethod(...$arguments);

        //Mapping ~As method calls omitting "As", returns the result wrapped with ArrayBuilder
        if(method_exists($this, $asMethod = $name . "As")){
            $this->exchangeArray($this->$asMethod(...$arguments));
            return $this;
        }

        //Mapping ~Key method calls omitting "Key", returns the value at that key
        if(method_exists($this, $keyMethod = $name . "Key"))
            return $this->toArray()[$this->$keyMethod(...$arguments)] ?? null;

        //Mapping array_function omitting "array_", returns array_function result, and save modified array to itself
        if(function_exists($arrayFunc = "array_" . $name)){
            //Mapping arguments with converting ArrayBuilder to array
            $arguments = Arr::map($arguments, function($value){ return $value instanceof \ArrayObject ? $value->getArrayCopy() : $value; });

            $array = $this->toArray();
            $result = $arrayFunc($array, ...$arguments);
            $this->exchangeTo($array);
            return $result;
        }

        throw new \Error("Call to undefined method " . ArrayBuilder::class . "::$name()");
    }

    /** @param array|\ArrayObject $value */
    public static function getArray($value) : array{
        if(is_array($value))
            return $value;

        if($value instanceof \ArrayObject)
            return $value->getArrayCopy();

        throw new \TypeError("Argument must be of the type array or ArrayBuilder, " . gettype($value) . " given");
    }
}