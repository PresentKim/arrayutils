<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

use kim\present\lib\arrayutils\ArrayUtils;

class MapBench extends BaseBench{

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_map($params){
        if($params[KEY_MODE] === MODE_NATIVE){
            array_map(function($i){ return $i * 2; }, $this->data);
        }else{
            ArrayUtils::mapFrom($this->data, function($i){ return $i * 2; });
        }
    }

    /**
     * @Revs(256)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_mapAssoc($params){
        $callback = function($v, $k){ return [$k, $v * 2]; };
        if($params[KEY_MODE] === MODE_NATIVE){
            $array = [];
            foreach($this->data as $k => $v){
                [$nk, $nv] = $callback($v, $k);
                $array[$nk] = $nv;
            }
        }else{
            ArrayUtils::mapAssocFrom($this->data, $callback);
        }
    }

    /**
     * @Revs(512)
     * @Iterations(5)
     * @Warmup(2)
     * @ParamProviders("provideMethods")
     */
    public function bench_mapKey($params){
        $callback = function($v, $k){ return $k + 1; };
        if($params[KEY_MODE] === MODE_NATIVE){
            $array = [];
            foreach($this->data as $k => $v){
                $array[$callback($v, $k)] = $v;
            }
        }else{
            ArrayUtils::mapKeyFrom($this->data, $callback);
        }
    }

}
