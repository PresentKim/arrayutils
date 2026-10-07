<?php

declare(strict_types=1);

namespace kim\present\lib\arrayutils\tests\unit;

use kim\present\lib\arrayutils\ArrayUtils;
use PHPUnit\Framework\TestCase;

use function is_int;

class ArrayUtilsTest extends TestCase{
    public function testInstanceMutatesAndAsDoesNot() : void{
        $utils = new ArrayUtils([3, 1, 2]);
        $this->assertSame([1, 2, 3], $utils->sortAs());
        $this->assertSame([3, 1, 2], $utils->getArrayCopy());
        $this->assertSame($utils, $utils->sort());
        $this->assertSame([1, 2, 3], $utils->getArrayCopy());
    }

    public function testFromVariants() : void{
        $this->assertSame([2, 4], ArrayUtils::mapFromAs([1, 2], static function($v){ return $v * 2; }));
        $this->assertSame([1 => 2], ArrayUtils::filterFrom([1, 2], static function($v){ return $v > 1; })->getArrayCopy());
        $this->assertSame(6, ArrayUtils::sumFrom([1, 2, 3]));
        $this->assertSame("<1,2>", ArrayUtils::joinFrom([1, 2], ",", "<", ">"));
    }

    public function testGeneratorsAreUnpacked() : void{
        $generator = static function(){
            yield "a" => 1;
            yield "b" => 2;
        };
        $this->assertSame(["a" => 1, "b" => 2], ArrayUtils::toArray($generator()));
        $this->assertSame([1, 2], ArrayUtils::valuesFromAs($generator()));
        $this->assertSame([[1], [2]], ArrayUtils::mapToArray([[1], new ArrayUtils([2])]));
    }

    public function testStackMethods() : void{
        $utils = new ArrayUtils([1, 2, 3]);
        $this->assertSame(3, $utils->pop());
        $this->assertSame(1, $utils->shift());
        $this->assertSame([2], $utils->getArrayCopy());
        $this->assertSame([2], $utils->splice(0, null, 9, 8));
        $this->assertSame([9, 8], $utils->getArrayCopy());
        $array = [1, 2];
        $this->assertSame(2, ArrayUtils::popFrom($array));
        $this->assertSame([1, 2], $array);
    }

    public function testSearchMethods() : void{
        $array = ["a" => 1, "b" => null, "c" => 3];
        $this->assertTrue(ArrayUtils::keyExistsFrom($array, "b"));
        $this->assertSame("c", ArrayUtils::indexOfFrom($array, 3));
        $this->assertNull(ArrayUtils::indexOfFrom($array, 3, 3));
        $this->assertTrue(ArrayUtils::includesFrom([1, 2, 3], 3, -1));
        $this->assertFalse(ArrayUtils::includesFrom([1, 2, 3], 1, 1));
        $this->assertSame(1, ArrayUtils::firstFrom($array));
        $this->assertSame(3, ArrayUtils::lastFrom($array));
        $this->assertSame("c", ArrayUtils::keyLastFrom($array));
        $this->assertNull(ArrayUtils::firstFrom([]));
        $this->assertNull(ArrayUtils::randomFrom([]));
    }

    public function testReduceRightKeepsKeys() : void{
        $keys = ArrayUtils::reduceRightFrom([5 => "a", 9 => "b"], static function($c, $v, $k){ $c[] = $k; return $c; }, []);
        $this->assertSame([9, 5], $keys);
    }

    public function testSliceAndFill() : void{
        $this->assertSame([2, 3], ArrayUtils::sliceFromAs([1, 2, 3, 4], 1, -1));
        $this->assertSame(["b" => 2], ArrayUtils::sliceFromAs(["a" => 1, "b" => 2], 1, null, true));
        $this->assertSame([1, "x", "x"], ArrayUtils::fillFromAs([1, 2, 3], "x", 1));
    }

    public function testEmptyVariadicsAreSafe() : void{
        $this->assertSame([1, 2], ArrayUtils::diffFromAs([1, 2]));
        $this->assertSame([1, 2], ArrayUtils::pushFromAs([1, 2]));
        $this->assertSame([1, 2], ArrayUtils::unshiftFromAs([1, 2]));
        $this->assertSame([0 => 1, "k" => 2], ArrayUtils::unshiftFromAs([5 => 1, "k" => 2]));
        $this->assertSame([1, 2], ArrayUtils::concatFromAs([1], [2]));
        $this->assertSame([], ArrayUtils::flatMapFromAs([], static function($v){ return $v; }));
    }

    public function testCallbacksReceiveOnlyDeclaredArguments() : void{
        $array = ["a" => 1, "b" => 2, "c" => 3];
        $one = static function($v){ return $v * 2; };
        $two = static function($v, $k){ return $k . $v; };
        $three = static function($v, $k, $all){ return $k . $v . count($all); };
        $variadic = static function(...$args){ return count($args); };

        $this->assertSame(["a" => 2, "b" => 4, "c" => 6], ArrayUtils::mapFromAs($array, $one));
        $this->assertSame(["a" => "a1", "b" => "b2", "c" => "c3"], ArrayUtils::mapFromAs($array, $two));
        $this->assertSame(["a" => "a13", "b" => "b23", "c" => "c33"], ArrayUtils::mapFromAs($array, $three));
        $this->assertSame(["a" => 3, "b" => 3, "c" => 3], ArrayUtils::mapFromAs($array, $variadic));

        $this->assertSame(["b" => 2, "c" => 3], ArrayUtils::filterFromAs($array, static function($v){ return $v > 1; }));
        $this->assertSame(["c" => 3], ArrayUtils::filterFromAs($array, static function($v, $k){ return $k === "c"; }));
        $this->assertSame(["a" => 1], ArrayUtils::filterFromAs($array, static function($v, $k, $all){ return $v === count($all) - 2; }));

        $this->assertSame(6, ArrayUtils::reduceFrom($array, static function($c, $v){ return $c + $v; }, 0));
        $this->assertSame("a1b2c3", ArrayUtils::reduceFrom($array, static function($c, $v, $k){ return $c . $k . $v; }, ""));
        $this->assertSame("c3b2a1", ArrayUtils::reduceRightFrom($array, static function($c, $v, $k){ return $c . $k . $v; }, ""));
        $this->assertSame(6, ArrayUtils::reduceRightFrom($array, static function($c, $v){ return $c + $v; }, 0));
        $this->assertTrue(ArrayUtils::everyFrom($array, static function($v){ return $v > 0; }));
        $this->assertTrue(ArrayUtils::someFrom($array, static function($v, $k){ return $k === "b"; }));
        $this->assertSame(2, ArrayUtils::findFrom($array, static function($v, $k){ return $k === "b"; }));
        $this->assertSame("c", ArrayUtils::findIndexFrom($array, static function($v){ return $v === 3; }));
    }

    public function testNonClosureCallbacks() : void{
        $this->assertSame(["A", "B"], ArrayUtils::mapFromAs(["a", "b"], "strtoupper"));
        $this->assertSame([2, 4], ArrayUtils::mapFromAs([1, 2], [$this, "double"]));
        $this->assertSame([3, 6], ArrayUtils::mapFromAs([1, 2], self::class . "::triple"));
        $this->assertSame([5, 6], ArrayUtils::mapFromAs([1, 2], new class{ public function __invoke($v){ return $v + 4; } }));
    }

    public function testResultsAreIndependentInstances() : void{
        $source = [1, 2, 3];
        $first = ArrayUtils::mapFrom($source, static function($v){ return $v; });
        $second = ArrayUtils::mapFrom($source, static function($v){ return $v * 2; });
        $first->push(4);
        $this->assertSame([1, 2, 3, 4], $first->getArrayCopy());
        $this->assertSame([2, 4, 6], $second->getArrayCopy());
        $this->assertSame([1, 2, 3], $source);
    }

    public function testLastAndKeyLast() : void{
        $this->assertSame(3, ArrayUtils::lastFrom(["a" => 1, 5 => 3]));
        $this->assertSame(5, ArrayUtils::keyLastFrom(["a" => 1, 5 => 3]));
        $this->assertFalse(ArrayUtils::lastFrom([1, false]));
        $this->assertNull(ArrayUtils::keyLastFrom([]));
    }

    public function double($v){ return $v * 2; }

    public static function triple($v){ return $v * 3; }
}
