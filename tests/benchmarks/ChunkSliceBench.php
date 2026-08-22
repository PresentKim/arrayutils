<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class ChunkSliceBench extends BaseBench{

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_chunk($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_chunk($this->data, 10);
        }else{
            ArrayUtils::chunkFrom($this->data, 10);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_slice($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_slice($this->data, 10, 50);
        }else{
            ArrayUtils::sliceFrom($this->data, 10, 60);
        }
    }

}
