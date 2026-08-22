<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class ReduceBench extends BaseBench{

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_reduce($params){
        $callback = function($carry, $item){ return $carry + $item; };
        if($params[KEY_MODE] === MODE_NATIVE){
            array_reduce($this->data, $callback, 0);
        }else{
            ArrayUtils::reduceFrom($this->data, $callback, 0);
        }
    }

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_reduceRight($params){
        $callback = function($carry, $item){ return $carry + $item; };
        if($params[KEY_MODE] === MODE_NATIVE){
            array_reduce(array_reverse($this->data), $callback, 0);
        }else{
            ArrayUtils::reduceRightFrom($this->data, $callback, 0);
        }
    }

}
