<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class FillPadBenchmark extends BaseBenchmark{

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_fill($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_fill(0, 10, 0);
        }else{
            ArrayUtils::fillFrom([], 0, 10, 0);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_fillKeys($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_fill_keys(['a', 'b', 'c'], 'value');
        }else{
            ArrayUtils::fillKeysFrom(['a', 'b', 'c'], 'value');
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_pad($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_pad($this->data, 1005, 'value');
        }else{
            ArrayUtils::padFrom($this->data, 1005, 'value');
        }
    }

}





