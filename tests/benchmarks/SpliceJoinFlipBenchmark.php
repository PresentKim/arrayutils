<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class SpliceJoinFlipBenchmark extends BaseBenchmark{

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_splice($params){
        $data = $this->data;
        if($params[KEY_MODE] === MODE_NATIVE){
            array_splice($data, 10, 5, [1, 2]);
        }else{
            ArrayUtils::spliceFrom($data, 10, 5, 1, 2);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_join($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            implode(',', $this->data);
        }else{
            ArrayUtils::joinFrom($this->data, ',');
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_flip($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_flip($this->data);
        }else{
            ArrayUtils::flipFrom($this->data);
        }
    }

}





