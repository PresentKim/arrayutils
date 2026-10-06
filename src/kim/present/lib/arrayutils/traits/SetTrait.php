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
use function array_count_values;
use function array_diff;
use function array_diff_assoc;
use function array_diff_key;
use function array_intersect;
use function array_intersect_assoc;
use function array_intersect_key;
use function array_unique;
use function is_array;

/**
 * Methods that compare arrays or collapse duplicates (diff, intersect, unique, countValues)
 *
 * Requires ArrayUtils::toArray() and ArrayUtils::mapToArray() of the class using this trait
 */
trait SetTrait{
    /**
     * Computes the difference of arrays
     *
     * @link https://arrayutils.docs.present.kim/methods/c/diff
     */
    public function diff(iterable ...$iterables) : ArrayUtils{
        $a = $this->getArrayCopy();
        $this->exchangeArray($iterables ? array_diff($a, ...self::mapToArray($iterables)) : $a);
        return $this;
    }

    /**
     * Same as diff(), but returns a plain array and leaves the instance unchanged
     */
    public function diffAs(iterable ...$iterables) : array{
        $a = $this->getArrayCopy();
        return $iterables ? array_diff($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Same as diff(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function diffFrom(iterable $from, iterable ...$iterables) : ArrayUtils{
        $a = (is_array($from) ? $from : self::toArray($from));
        return new self($iterables ? array_diff($a, ...self::mapToArray($iterables)) : $a);
    }

    /**
     * Same as diffFrom(), but returns a plain array
     */
    public static function diffFromAs(iterable $from, iterable ...$iterables) : array{
        $a = (is_array($from) ? $from : self::toArray($from));
        return $iterables ? array_diff($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * All similar to diff(), but this applies with additional index check
     *
     * @link https://arrayutils.docs.present.kim/methods/c/diff/assoc
     */
    public function diffAssoc(iterable ...$iterables) : ArrayUtils{
        $a = $this->getArrayCopy();
        $this->exchangeArray($iterables ? array_diff_assoc($a, ...self::mapToArray($iterables)) : $a);
        return $this;
    }

    /**
     * Same as diffAssoc(), but returns a plain array and leaves the instance unchanged
     */
    public function diffAssocAs(iterable ...$iterables) : array{
        $a = $this->getArrayCopy();
        return $iterables ? array_diff_assoc($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Same as diffAssoc(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function diffAssocFrom(iterable $from, iterable ...$iterables) : ArrayUtils{
        $a = (is_array($from) ? $from : self::toArray($from));
        return new self($iterables ? array_diff_assoc($a, ...self::mapToArray($iterables)) : $a);
    }

    /**
     * Same as diffAssocFrom(), but returns a plain array
     */
    public static function diffAssocFromAs(iterable $from, iterable ...$iterables) : array{
        $a = (is_array($from) ? $from : self::toArray($from));
        return $iterables ? array_diff_assoc($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * All similar to diff(), but this applies to keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/diff/key
     */
    public function diffKey(iterable ...$iterables) : ArrayUtils{
        $a = $this->getArrayCopy();
        $this->exchangeArray($iterables ? array_diff_key($a, ...self::mapToArray($iterables)) : $a);
        return $this;
    }

    /**
     * Same as diffKey(), but returns a plain array and leaves the instance unchanged
     */
    public function diffKeyAs(iterable ...$iterables) : array{
        $a = $this->getArrayCopy();
        return $iterables ? array_diff_key($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Same as diffKey(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function diffKeyFrom(iterable $from, iterable ...$iterables) : ArrayUtils{
        $a = (is_array($from) ? $from : self::toArray($from));
        return new self($iterables ? array_diff_key($a, ...self::mapToArray($iterables)) : $a);
    }

    /**
     * Same as diffKeyFrom(), but returns a plain array
     */
    public static function diffKeyFromAs(iterable $from, iterable ...$iterables) : array{
        $a = (is_array($from) ? $from : self::toArray($from));
        return $iterables ? array_diff_key($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Computes the intersection of arrays
     *
     * @link https://arrayutils.docs.present.kim/methods/c/intersect
     */
    public function intersect(iterable ...$iterables) : ArrayUtils{
        $a = $this->getArrayCopy();
        $this->exchangeArray($iterables ? array_intersect($a, ...self::mapToArray($iterables)) : $a);
        return $this;
    }

    /**
     * Same as intersect(), but returns a plain array and leaves the instance unchanged
     */
    public function intersectAs(iterable ...$iterables) : array{
        $a = $this->getArrayCopy();
        return $iterables ? array_intersect($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Same as intersect(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function intersectFrom(iterable $from, iterable ...$iterables) : ArrayUtils{
        $a = (is_array($from) ? $from : self::toArray($from));
        return new self($iterables ? array_intersect($a, ...self::mapToArray($iterables)) : $a);
    }

    /**
     * Same as intersectFrom(), but returns a plain array
     */
    public static function intersectFromAs(iterable $from, iterable ...$iterables) : array{
        $a = (is_array($from) ? $from : self::toArray($from));
        return $iterables ? array_intersect($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * All similar to intersect(), but this applies to both keys and values
     *
     * @link https://arrayutils.docs.present.kim/methods/c/intersect/assoc
     */
    public function intersectAssoc(iterable ...$iterables) : ArrayUtils{
        $a = $this->getArrayCopy();
        $this->exchangeArray($iterables ? array_intersect_assoc($a, ...self::mapToArray($iterables)) : $a);
        return $this;
    }

    /**
     * Same as intersectAssoc(), but returns a plain array and leaves the instance unchanged
     */
    public function intersectAssocAs(iterable ...$iterables) : array{
        $a = $this->getArrayCopy();
        return $iterables ? array_intersect_assoc($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Same as intersectAssoc(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function intersectAssocFrom(iterable $from, iterable ...$iterables) : ArrayUtils{
        $a = (is_array($from) ? $from : self::toArray($from));
        return new self($iterables ? array_intersect_assoc($a, ...self::mapToArray($iterables)) : $a);
    }

    /**
     * Same as intersectAssocFrom(), but returns a plain array
     */
    public static function intersectAssocFromAs(iterable $from, iterable ...$iterables) : array{
        $a = (is_array($from) ? $from : self::toArray($from));
        return $iterables ? array_intersect_assoc($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * All similar to intersect(), but this applies to keys
     *
     * @link https://arrayutils.docs.present.kim/methods/c/intersect/key
     */
    public function intersectKey(iterable ...$iterables) : ArrayUtils{
        $a = $this->getArrayCopy();
        $this->exchangeArray($iterables ? array_intersect_key($a, ...self::mapToArray($iterables)) : $a);
        return $this;
    }

    /**
     * Same as intersectKey(), but returns a plain array and leaves the instance unchanged
     */
    public function intersectKeyAs(iterable ...$iterables) : array{
        $a = $this->getArrayCopy();
        return $iterables ? array_intersect_key($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Same as intersectKey(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function intersectKeyFrom(iterable $from, iterable ...$iterables) : ArrayUtils{
        $a = (is_array($from) ? $from : self::toArray($from));
        return new self($iterables ? array_intersect_key($a, ...self::mapToArray($iterables)) : $a);
    }

    /**
     * Same as intersectKeyFrom(), but returns a plain array
     */
    public static function intersectKeyFromAs(iterable $from, iterable ...$iterables) : array{
        $a = (is_array($from) ? $from : self::toArray($from));
        return $iterables ? array_intersect_key($a, ...self::mapToArray($iterables)) : $a;
    }

    /**
     * Removes duplicate values from an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/unique
     */
    public function unique(int $sortFlags = SORT_STRING) : ArrayUtils{
        $this->exchangeArray(array_unique($this->getArrayCopy(), $sortFlags));
        return $this;
    }

    /**
     * Same as unique(), but returns a plain array and leaves the instance unchanged
     */
    public function uniqueAs(int $sortFlags = SORT_STRING) : array{
        return array_unique($this->getArrayCopy(), $sortFlags);
    }

    /**
     * Same as unique(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function uniqueFrom(iterable $from, int $sortFlags = SORT_STRING) : ArrayUtils{
        return new self(array_unique((is_array($from) ? $from : self::toArray($from)), $sortFlags));
    }

    /**
     * Same as uniqueFrom(), but returns a plain array
     */
    public static function uniqueFromAs(iterable $from, int $sortFlags = SORT_STRING) : array{
        return array_unique((is_array($from) ? $from : self::toArray($from)), $sortFlags);
    }

    /**
     * Counts all the values of an array
     *
     * @link https://arrayutils.docs.present.kim/methods/c/count-values
     */
    public function countValues() : ArrayUtils{
        $this->exchangeArray(array_count_values($this->getArrayCopy()));
        return $this;
    }

    /**
     * Same as countValues(), but returns a plain array and leaves the instance unchanged
     */
    public function countValuesAs() : array{
        return array_count_values($this->getArrayCopy());
    }

    /**
     * Same as countValues(), but operates on the given iterable and returns a new ArrayUtils
     */
    public static function countValuesFrom(iterable $from) : ArrayUtils{
        return new self(array_count_values((is_array($from) ? $from : self::toArray($from))));
    }

    /**
     * Same as countValuesFrom(), but returns a plain array
     */
    public static function countValuesFromAs(iterable $from) : array{
        return array_count_values((is_array($from) ? $from : self::toArray($from)));
    }
}
