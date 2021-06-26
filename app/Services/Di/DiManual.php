<?php

namespace App\Services\Di;

//手动，控制反转和依赖注入
class DiManual
{
    public $diService;

    public function __construct(DiService $diService)
    {
        /**
         * 因为我需要DiService()提供数据，所以创建一个DiService对象
         * 把依赖从外部传入进来，把需要的依赖传入进来就是依赖注入
         *
         * 控制：调用者控制了DiService对象的创建
         * 反转：我DiManual控制DiService创建的权利没有了，转移给调用者
         */
        $this->diService = $diService;
    }

    public function index()
    {
        return '手动模式--'.$this->diService->getContent();
    }
}
