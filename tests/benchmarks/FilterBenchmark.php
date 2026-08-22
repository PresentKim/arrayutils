<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class FilterBenchmark extends BaseBenchmark{

    /**
     * @Revs(256)
     * @Iterations(3)
     * @ParamProviders("provideMethods")
     */
    public function bench_filter($params){
        $callback = function($i){ return $i % 2 === 0; };
        if($params[KEY_MODE] === MODE_NATIVE){
            array_filter($this->data, $callback);
        }else{
            ArrayUtils::filterFrom($this->data, $callback);
        }
    }

    /**
     * @Revs(256)
     * @Iterations(3)
     * @ParamProviders("provideMethods")
     */
    public function bench_some($params){
        $callback = function($i){ return $i === 500; };
        if($params[KEY_MODE] === MODE_NATIVE){
            foreach($this->data as $i){
                if($callback($i)) break;
            }
        }else{
            ArrayUtils::someFrom($this->data, $callback);
        }
    }

    /**
     * @Revs(256)
     * @Iterations(3)
     * @ParamProviders("provideMethods")
     */
    public function bench_every($params){
        $callback = function($i){ return $i > 0; };
        if($params[KEY_MODE] === MODE_NATIVE){
            foreach($this->data as $i){
                if(!$callback($i)) break;
            }
        }else{
            ArrayUtils::everyFrom($this->data, $callback);
        }
    }

}





