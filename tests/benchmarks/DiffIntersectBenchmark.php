<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class DiffIntersectBenchmark extends BaseBenchmark{

    protected function initData() : void{
        $this->data = range(500, 1500);
    }

    /**
     * @Revs(256)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_diff($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_diff($this->data, $this->data);
        }else{
            ArrayUtils::diffFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(256)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_diffAssoc($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_diff_assoc($this->data, $this->data);
        }else{
            ArrayUtils::diffAssocFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_diffKey($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_diff_key($this->data, $this->data);
        }else{
            ArrayUtils::diffKeyFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(128)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_intersect($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_intersect($this->data, $this->data);
        }else{
            ArrayUtils::intersectFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(256)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_intersectAssoc($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_intersect_assoc($this->data, $this->data);
        }else{
            ArrayUtils::intersectAssocFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_intersectKey($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_intersect_key($this->data, $this->data);
        }else{
            ArrayUtils::intersectKeyFrom($this->data, $this->data);
        }
    }

}
