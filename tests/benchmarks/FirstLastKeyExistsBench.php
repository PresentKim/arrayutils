<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class FirstLastKeyExistsBench extends BaseBench{

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_first($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            reset($this->data);
        }else{
            ArrayUtils::firstFrom($this->data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_keyFirst($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            reset($this->data);
            key($this->data);
        }else{
            ArrayUtils::keyFirstFrom($this->data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_last($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            end($this->data);
            current($this->data);
        }else{
            ArrayUtils::lastFrom($this->data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_keyLast($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            end($this->data);
            key($this->data);
        }else{
            ArrayUtils::keyLastFrom($this->data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_keyExists($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_key_exists(500, $this->data);
        }else{
            ArrayUtils::keyExistsFrom($this->data, 500);
        }
    }

}
