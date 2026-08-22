<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class StackQueueBenchmark extends BaseBenchmark{

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_push($params){
        $data = $this->data;
        if($params[KEY_MODE] === MODE_NATIVE){
            array_push($data, 1001);
        }else{
            ArrayUtils::pushFrom($data, 1001);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_unshift($params){
        $data = $this->data;
        if($params[KEY_MODE] === MODE_NATIVE){
            array_unshift($data, 0);
        }else{
            ArrayUtils::unshiftFrom($data, 0);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_pop($params){
        $data = $this->data;
        if($params[KEY_MODE] === MODE_NATIVE){
            array_pop($data);
        }else{
            ArrayUtils::popFrom($data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_shift($params){
        $data = $this->data;
        if($params[KEY_MODE] === MODE_NATIVE){
            array_shift($data);
        }else{
            ArrayUtils::shiftFrom($data);
        }
    }

}
