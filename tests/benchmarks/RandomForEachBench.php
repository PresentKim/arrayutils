<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class RandomForEachBench extends BaseBench{

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_random($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            $this->data[array_rand($this->data)];
        }else{
            ArrayUtils::randomFrom($this->data);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_keyRandom($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_rand($this->data);
        }else{
            ArrayUtils::keyRandomFrom($this->data);
        }
    }

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_forEach($params){
        $callback = function($v, $k){ return $v * 2; };
        if($params[KEY_MODE] === MODE_NATIVE){
            foreach($this->data as $k => $v){
                $callback($v, $k);
            }
        }else{
            ArrayUtils::forEachFrom($this->data, $callback);
        }
    }

}
