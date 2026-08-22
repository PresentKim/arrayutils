<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class ConcatMergeBench extends BaseBench{

    protected function initData() : void{
        $this->data = range(1001, 2000);
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_concat($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_merge($this->data, $this->data);
        }else{
            ArrayUtils::concatFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_concatSoft($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_merge($this->data, $this->data);
        }else{
            ArrayUtils::concatSoftFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_merge($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_merge($this->data, $this->data);
        }else{
            ArrayUtils::mergeFrom($this->data, $this->data);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_mergeSoft($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_merge($this->data, $this->data);
        }else{
            ArrayUtils::mergeSoftFrom($this->data, $this->data);
        }
    }

}
