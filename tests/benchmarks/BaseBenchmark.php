<?php

namespace kim\present\lib\arrayutils\tests\benchmarks;

const KEY_MODE = 0;
const MODE_NATIVE = 0;
const MODE_ARRAY_UTILS = 1;

abstract class BaseBenchmark{

    /** @var array */
    protected $data;

    public function __construct(){
        $this->initData();
    }

    protected function initData() : void{
        $this->data = range(1, 1000);
    }

    public function provideMethods() : array{
        return [
            'native' => [KEY_MODE => MODE_NATIVE],
            'arrayutils' => [KEY_MODE => MODE_ARRAY_UTILS],
        ];
    }

}
