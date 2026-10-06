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

namespace kim\present\lib\arrayutils;

use ArrayObject;
use Traversable;
use kim\present\lib\arrayutils\traits\ConcatTrait;
use kim\present\lib\arrayutils\traits\IterationTrait;
use kim\present\lib\arrayutils\traits\SearchTrait;
use kim\present\lib\arrayutils\traits\SetTrait;
use kim\present\lib\arrayutils\traits\ShapeTrait;
use kim\present\lib\arrayutils\traits\SortTrait;
use kim\present\lib\arrayutils\traits\StackTrait;

use function is_array;
use function iterator_to_array;

/**
 * Class ArrayUtils is provides a method to fancy manipulate an array
 *
 * Declare methods that implements internal array functions,
 * And methods that implements javascript array methods
 *
 * Every method is declared explicitly in the traits below (no magic methods), in up to four variants:
 *  - name()         Applies to this instance and returns it
 *  - nameAs()       Returns the result as a plain array, leaving this instance unchanged
 *  - nameFrom()     Static. Applies to the given iterable and returns a new ArrayUtils
 *  - nameFromAs()   Static. Applies to the given iterable and returns a plain array
 * Methods that do not return an array (every, includes, first, join ...) only have name() and nameFrom()
 *
 * @link https://arrayutils.docs.present.kim/
 */
class ArrayUtils extends ArrayObject{
    use ConcatTrait;
    use IterationTrait;
    use SearchTrait;
    use SetTrait;
    use ShapeTrait;
    use SortTrait;
    use StackTrait;

    /** Creates a new, shallow-copied ArrayUtils instance from an iterable */
    public function __construct(iterable $iterable, int $flags = 0, string $iteratorClass = "ArrayIterator"){
        parent::__construct(is_array($iterable) ? $iterable : self::toArray($iterable), $flags, $iteratorClass);
    }

    /**
     * Creates a new, shallow-copied ArrayUtils instance from an iterable
     *
     * @param iterable  $iterable
     * @param ?callable $mapFn = null
     *
     * @link https://arrayutils.docs.present.kim/methods/s/from
     */
    public static function from(iterable $iterable, ?callable $mapFn = null) : ArrayUtils{
        $instance = new self($iterable);
        if($mapFn !== null){
            $instance = $instance->map($mapFn);
        }
        return $instance;
    }

    /**
     * Creates a new, ArrayUtils instance from variadic function arguments
     *
     * @param mixed ...$elements
     *
     * @link https://arrayutils.docs.present.kim/methods/s/of
     */
    public static function of(...$elements) : ArrayUtils{
        return new self($elements);
    }

    /**
     * Cast all elements of the iterable to an array
     *
     * @link https://arrayutils.docs.present.kim/methods/s/maptoarray
     */
    public static function mapToArray(iterable $iterables) : array{
        $result = [];
        foreach(is_array($iterables) ? $iterables : self::toArray($iterables) as $key => $iterable){
            $result[$key] = $iterable instanceof Traversable ? self::toArray($iterable) : (array) $iterable;
        }
        return $result;
    }

    /**
     * Converts an iterable to an array, keeping the keys
     * Unlike an (array) cast, this also unpacks generators and other iterators
     */
    public static function toArray(iterable $iterable) : array{
        if(is_array($iterable)){
            return $iterable;
        }
        if($iterable instanceof ArrayObject){
            return $iterable->getArrayCopy();
        }
        return iterator_to_array($iterable, true);
    }

    /** Exchange the array for another one */
    public function exchange(array $array) : ArrayUtils{
        $this->exchangeArray($array);
        return $this;
    }
}
