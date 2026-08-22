<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class SortReverseBenchmark extends BaseBenchmark{

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_sort($params){
        $data = $this->data;
        if($params[KEY_MODE] === MODE_NATIVE){
            sort($data);
        }else{
            ArrayUtils::sortFrom($data);
        }
    }

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_sortKey($params){
        $data = $this->data;
        if($params[KEY_MODE] === MODE_NATIVE){
            ksort($data);
        }else{
            ArrayUtils::sortKeyFrom($data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_reverse($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_reverse($this->data);
        }else{
            ArrayUtils::reverseFrom($this->data);
        }
    }

}





