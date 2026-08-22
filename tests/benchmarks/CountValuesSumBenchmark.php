<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class CountValuesSumBenchmark extends BaseBenchmark{

    /**
     * @Revs(256)
     * @Iterations(3)
     * @ParamProviders("provideMethods")
     */
    public function bench_countValues($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_count_values([1, 1, 2, 2, 3]);
        }else{
            ArrayUtils::countValuesFrom([1, 1, 2, 2, 3]);
        }
    }

    /**
     * @Revs(256)
     * @Iterations(3)
     * @ParamProviders("provideMethods")
     */
    public function bench_sum($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_sum($this->data);
        }else{
            ArrayUtils::sumFrom($this->data);
        }
    }

}





