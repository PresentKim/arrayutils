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

    public function join(string $glue = "") : string{
        return implode($glue, $this->toArray());
    }

    public function toArray() : array{
        return $this->__toArray();
    }

    public function __toArray() : array{
        return $this->getArrayCopy();
    }

    public function slice(int $offset, ?int $length = null, bool $preserveKeys = false) : ArrayBuilder{
        return $this->exchangeTo(array_slice($this->toArray(), $offset, $length, $preserveKeys));
    }

    public function map(callable $callable) : ArrayBuilder{
        return $this->exchangeTo(array_map($callable, $this->toArray()));
    }

    public function filter(callable $callable, int $flag = 0) : ArrayBuilder{
        return $this->exchangeTo(array_filter($this->toArray(), $callable, $flag));
    }

    public function keys() : ArrayBuilder{
        return $this->exchangeTo(array_keys($this->toArray()));
    }

    public function values() : ArrayBuilder{
        return $this->exchangeTo(array_values($this->toArray()));
    }

    public function combine() : ArrayBuilder{
        return $this->exchangeTo(array_combine($array = $this->toArray(), $array));
    }

    /** @param array|ArrayBuilder $array */
    public function merge($array) : ArrayBuilder{
        return $this->exchangeTo(array_merge_recursive($this->toArray(), self::getArray($array)));
    }

    /** @param array|ArrayBuilder $array */
    public function mergeSoft($array) : ArrayBuilder{
        return $this->exchangeTo(array_merge_recursive($origin = $this->toArray(), array_diff_key(self::getArray($array), $origin)));
    }

    public function mapAssoc(callable $callable) : ArrayBuilder{
        return $this->exchangeTo(array_column(array_map($callable, array_keys($array = $this->toArray()), $array), 1, 0));
    }

    public function keyMap(callable $callable) : ArrayBuilder{
        return $this->mapAssoc(function($_, $value) use ($callable){
            return [$callable($value), $value];
        });
    }

    public function __toString() : string{
        return $this->join("");
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