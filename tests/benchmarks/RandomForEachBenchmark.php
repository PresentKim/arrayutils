<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class RandomForEachBenchmark extends BaseBenchmark{

    /**
     * @Revs(256)
     * @Iterations(3)
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
     * @Revs(256)
     * @Iterations(3)
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
     * @Revs(256)
     * @Iterations(3)
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





