<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class UniqueReplaceBenchmark extends BaseBenchmark{

    protected function initData() : void{
        $this->data = [];
        for($i = 0; $i < 1000; $i++){
            $this->data[] = $i % 100;
        }
    }

    /**
     * @Revs(256)
     * @Iterations(3)
     * @ParamProviders("provideMethods")
     */
    public function bench_unique($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_unique($this->data);
        }else{
            ArrayUtils::uniqueFrom($this->data);
        }
    }

    /**
     * @Revs(256)
     * @Iterations(3)
     * @ParamProviders("provideMethods")
     */
    public function bench_replace($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_replace_recursive($this->data, [500 => 5000]);
        }else{
            ArrayUtils::replaceFrom($this->data, [500 => 5000]);
        }
    }

}





