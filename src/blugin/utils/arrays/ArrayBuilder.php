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

use blugin\utils\arrays\ArrayUtil as Arr;

/**
 * @method mixed first()
 * @method mixed last()
 * @method mixed random()
 *
 * @method self slice(int $offset, ?int $length = null, bool $preserveKeys = false)
 * @method self map(callable $callable)
 * @method self filter(callable $callable, int $flag = 0)
 * @method self keys()
 * @method self values()
 * @method self combine()
 * @method self merge(array|self $array)
 * @method self mergeSoft(array|self $array)
 * @method self mapAssoc(callable $callable)
 * @method self keyMap(callable $callable)
 * @method array sliceAs(int $offset, ?int $length = null, bool $preserveKeys = false)
 * @method array filterAs(callable $callable, int $flag = 0)
 * @method array keysAs()
 * @method array valuesAs()
 *
 * @method array toArray()
 * @method string toString()
 */
class ArrayBuilder extends \ArrayObject{
    /** @param array|ArrayBuilder $array */
    public function __construct($array, $flags = 0, $iteratorClass = "ArrayIterator"){
        parent::__construct(self::getArray($array), $flags, $iteratorClass);
    }

    /** @param array|ArrayBuilder $array */
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

    public function mapAs(callable $callable) : array{
        return array_map($callable, $this->toArray());
    }

    public function combineAs() : array{
        return array_combine($array = $this->toArray(), $array);
    }

    /** @param array|ArrayBuilder $array */
    public function mergeAs($array) : array{
        return array_merge_recursive($this->toArray(), self::getArray($array));
    }

    /** @param array|ArrayBuilder $array */
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

    public function __toArray() : array{
        return $this->getArrayCopy();
    }

    public function __toString() : string{
        return $this->join("");
    }

    /** @throws \Error */
    public function __call(string $name, array $arguments){
        try{
            //Mapping magic method calls omitting "__"
            if(method_exists($this, $magicMethod = "__" . $name))
                return $this->$magicMethod(...$arguments);

            //Mapping ~As method calls omitting "As", returns the result wrapped with ArrayBuilder
            if(method_exists($this, $asMethod = $name . "As"))
                return $this->exchangeTo($this->$asMethod(...$arguments));

            //Mapping ~Key method calls omitting "Key", returns the value at that key
            if(method_exists($this, $keyMethod = $name . "Key"))
                return $this->toArray()[$this->$keyMethod(...$arguments)] ?? null;

            //Mapping array_function omitting "array_" (and ends with "As" or not), returns array_function result, and save modified array to itself
            if(substr($name, -2) === "As"){
                $name = substr($name, 0, strlen($name) - 2);
            }
            if(function_exists($arrayFunc = "array_" . $name)){
                //Mapping arguments with converting ArrayBuilder to array
                $arguments = Arr::map($arguments, function($value){ return $value instanceof self ? $value->toArray() : $value; });

                $array = $this->toArray();
                $result = $arrayFunc($array, ...$arguments);
                $this->exchangeTo($array);
                return $result;
            }
        }finally{
            throw new \Error("Call to undefined method " . self::class . "::$name()");
        }
    }

    /** @param array|ArrayBuilder $value */
    public static function getArray($value) : array{
        if(is_array($value))
            return $value;

        if($value instanceof ArrayBuilder)
            return $value->toArray();

        throw new \TypeError("Argument must be of the type array or ArrayBuilder, " . gettype($value) . " given");
    }
}