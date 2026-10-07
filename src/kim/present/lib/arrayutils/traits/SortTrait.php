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
use function is_array;
use function ksort;
use function sort;
use function uksort;
use function usort;

/**
 * Methods that reorder the elements (sort, sortKey, reverse)
 *
 * Requires ArrayUtils::toArray() and ArrayUtils::mapToArray() of the class using this trait
 */
trait SortTrait{
    /**
     * Sort an array by values using a $callback function or default sort function
     * If $callback is null, run sort(), else run usort()
     *
     * @link https://arrayutils.docs.present.kim/methods/c/sort
     */
    public function sort(?callable $callback = null) : ArrayUtils{
        $this->exchangeArray(self::sortFromAs($this->getArrayCopy(), $callback));
        return $this;
    }

    /**
     * Same as sort(), but returns a plain array and leaves the instance unchanged
     */
    public function sortAs(?callable $callback = null) : array{
        return self::sortFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as sort(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function sortFrom(iterable $from, ?callable $callback = null) : ArrayUtils{
        return new self(self::sortFromAs($from, $callback));
    }

    /**
     * Same as sortFrom(), but returns a plain array
     */
    public static function sortFromAs(iterable $from, ?callable $callback = null) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        if($callback === null){
            sort($array);
        }else{
            usort($array, $callback);
        }
        return $array;
    }

    /**
     * Sort an array by keys using a $callback function or default sort function
     * If $callback is null, run ksort(), else run uksort()
     *
     * @link https://arrayutils.docs.present.kim/methods/c/sort/key
     */
    public function sortKey(?callable $callback = null) : ArrayUtils{
        $this->exchangeArray(self::sortKeyFromAs($this->getArrayCopy(), $callback));
        return $this;
    }

    /**
     * Same as sortKey(), but returns a plain array and leaves the instance unchanged
     */
    public function sortKeyAs(?callable $callback = null) : array{
        return self::sortKeyFromAs($this->getArrayCopy(), $callback);
    }

    /**
     * Same as sortKey(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function sortKeyFrom(iterable $from, ?callable $callback = null) : ArrayUtils{
        return new self(self::sortKeyFromAs($from, $callback));
    }

    /**
     * Same as sortKeyFrom(), but returns a plain array
     */
    public static function sortKeyFromAs(iterable $from, ?callable $callback = null) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        if($callback === null){
            ksort($array);
        }else{
            uksort($array, $callback);
        }
        return $array;
    }

    /**
     * Returns an array with elements in reverse order
     *
     * @link https://arrayutils.docs.present.kim/methods/c/reverse
     */
    public function reverse(bool $preserveKeys = false) : ArrayUtils{
        $this->exchangeArray(array_reverse($this->getArrayCopy(), $preserveKeys));
        return $this;
    }

    /**
     * Same as reverse(), but returns a plain array and leaves the instance unchanged
     */
    public function reverseAs(bool $preserveKeys = false) : array{
        return array_reverse($this->getArrayCopy(), $preserveKeys);
    }

    /**
     * Same as reverse(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function reverseFrom(iterable $from, bool $preserveKeys = false) : ArrayUtils{
        return new self(array_reverse((is_array($from) ? $from : self::toArray($from)), $preserveKeys));
    }

    /**
     * Same as reverseFrom(), but returns a plain array
     */
    public static function reverseFromAs(iterable $from, bool $preserveKeys = false) : array{
        return array_reverse((is_array($from) ? $from : self::toArray($from)), $preserveKeys);
    }
}
