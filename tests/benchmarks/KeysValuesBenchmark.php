<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class KeysValuesBenchmark extends BaseBenchmark{

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_keys($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_keys($this->data);
        }else{
            ArrayUtils::keysFrom($this->data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_values($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_values($this->data);
        }else{
            ArrayUtils::valuesFrom($this->data);
        }
    }

}
