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
use function array_pop;
use function array_push;
use function array_shift;
use function array_splice;
use function array_unshift;
use function count;
use function is_array;

/**
 * Methods that add or remove elements at a position (push, pop, shift, unshift, splice)
 *
 * Requires ArrayUtils::toArray() and ArrayUtils::mapToArray() of the class using this trait
 */
trait StackTrait{
    /**
     * Push elements onto the end of array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/push
     */
    public function push(...$values) : ArrayUtils{
        $this->exchangeArray(self::pushFromAs($this->getArrayCopy(), ...$values));
        return $this;
    }

    /**
     * Same as push(), but returns a plain array and leaves the instance unchanged
     */
    public function pushAs(...$values) : array{
        return self::pushFromAs($this->getArrayCopy(), ...$values);
    }

    /**
     * Same as push(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function pushFrom(iterable $from, ...$values) : ArrayUtils{
        return new self(self::pushFromAs($from, ...$values));
    }

    /**
     * Same as pushFrom(), but returns a plain array
     */
    public static function pushFromAs(iterable $from, ...$values) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        if($values){
            array_push($array, ...$values);
        }
        return $array;
    }

    /**
     * Push elements onto the start of array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/unshift
     */
    public function unshift(...$values) : ArrayUtils{
        $this->exchangeArray(self::unshiftFromAs($this->getArrayCopy(), ...$values));
        return $this;
    }

    /**
     * Same as unshift(), but returns a plain array and leaves the instance unchanged
     */
    public function unshiftAs(...$values) : array{
        return self::unshiftFromAs($this->getArrayCopy(), ...$values);
    }

    /**
     * Same as unshift(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function unshiftFrom(iterable $from, ...$values) : ArrayUtils{
        return new self(self::unshiftFromAs($from, ...$values));
    }

    /**
     * Same as unshiftFrom(), but returns a plain array
     */
    public static function unshiftFromAs(iterable $from, ...$values) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        if($values){
            array_unshift($array, ...$values);
            return $array;
        }

        //Without values, array_unshift() only renumbers the integer keys (calling it without values is invalid before PHP 7.3)
        $result = [];
        foreach($array as $key => $value){
            if(is_int($key)){
                $result[] = $value;
            }else{
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * Removes the last element and returns that element
     *
     * @link https://arrayutils.docs.present.kim/methods/g/pop
     */
    public function pop(){
        $array = $this->getArrayCopy();
        $value = array_pop($array);
        $this->exchangeArray($array);
        return $value;
    }

    /**
     * Same as pop(), but operates on a copy of the given iterable (the given iterable is not modified)
     *
     * @link https://arrayutils.docs.present.kim/methods/g/pop
     */
    public static function popFrom(iterable $from){
        $array = is_array($from) ? $from : self::toArray($from);
        return array_pop($array);
    }

    /**
     * Removes the first element and returns that element
     *
     * @link https://arrayutils.docs.present.kim/methods/g/shift
     */
    public function shift(){
        $array = $this->getArrayCopy();
        $value = array_shift($array);
        $this->exchangeArray($array);
        return $value;
    }

    /**
     * Same as shift(), but operates on a copy of the given iterable (the given iterable is not modified)
     *
     * @link https://arrayutils.docs.present.kim/methods/g/shift
     */
    public static function shiftFrom(iterable $from){
        $array = is_array($from) ? $from : self::toArray($from);
        return array_shift($array);
    }

    /**
     * Remove a portion of the array and replace it with something else
     * If $length is null, removes everything from $offset to the end
     *
     * @return array The removed elements
     * @link https://arrayutils.docs.present.kim/methods/g/splice
     */
    public function splice(int $offset, ?int $length = null, ...$replacement) : array{
        $array = $this->getArrayCopy();
        $removed = array_splice($array, $offset, $length ?? count($array), $replacement);
        $this->exchangeArray($array);
        return $removed;
    }

    /**
     * Same as splice(), but operates on a copy of the given iterable (the given iterable is not modified)
     *
     * @return array The removed elements
     * @link https://arrayutils.docs.present.kim/methods/g/splice
     */
    public static function spliceFrom(iterable $from, int $offset, ?int $length = null, ...$replacement) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        return array_splice($array, $offset, $length ?? count($array), $replacement);
    }
}
