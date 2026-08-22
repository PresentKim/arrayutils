<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class IncludesFindSearchBenchmark extends BaseBenchmark{

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_includes($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            in_array(500, $this->data, true);
        }else{
            ArrayUtils::includesFrom($this->data, 500);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_indexOf($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_search(500, $this->data, true);
        }else{
            ArrayUtils::indexOfFrom($this->data, 500);
        }
    }

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_find($params){
        $callback = function($i){ return $i === 500; };
        if($params[KEY_MODE] === MODE_NATIVE){
            foreach($this->data as $i){
                if($callback($i)) return $i;
            }
        }else{
            ArrayUtils::findFrom($this->data, $callback);
        }
    }

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_findIndex($params){
        $callback = function($i){ return $i === 500; };
        if($params[KEY_MODE] === MODE_NATIVE){
            foreach($this->data as $k => $i){
                if($callback($i)) return $k;
            }
        }else{
            ArrayUtils::findIndexFrom($this->data, $callback);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_search($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_search(500, $this->data, true);
        }else{
            ArrayUtils::searchFrom($this->data, 500);
        }
    }

}
