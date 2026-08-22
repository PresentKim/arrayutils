<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class ColumnCombineFlatBenchmark extends BaseBenchmark{

    protected function initData() : void{
        $this->data = [['id' => 1, 'name' => 'a'], ['id' => 2, 'name' => 'b']];
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_column($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_column($this->data, 'name');
        }else{
            ArrayUtils::columnFrom($this->data, 'name');
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_combine($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_combine(['a', 'b'], [1, 2]);
        }else{
            ArrayUtils::combineFrom(['a', 'b'], [1, 2]);
        }
    }

    /**
     * @Revs(2048)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_flat($params){
        $data = [[1, 2], [3, 4]];
        if($params[KEY_MODE] === MODE_NATIVE){
            array_merge(...$data);
        }else{
            ArrayUtils::flatFrom($data);
        }
    }

    /**
     * @Revs(1024)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_flatMap($params){
        $data = [1, 2, 3];
        $callback = function($i){ return [$i, $i * 2]; };
        if($params[KEY_MODE] === MODE_NATIVE){
            $result = [];
            foreach($data as $i){
                $result = array_merge($result, $callback($i));
            }
        }else{
            ArrayUtils::flatMapFrom($data, $callback);
        }
    }

}





