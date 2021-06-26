<?php

namespace App\Services\Di;

//常规代码，没有控制反转和依赖注入
class DiNo
{
    public $diService;

    public function __construct()
    {
        /**
         * 因为我需要DiService()提供数据，所以创建一个DiService对象
         * 控制：我DiNo控制了DiService对象的创建
         * 反转：我DiNo绝对控制DiService对象的权利，创建对象的控制权没有发生转移，所以没有反转，一切都是亲力亲为。
         */
        $this->diService = new DiService();
    }

    public function index()
    {
        return '普通模式--'.$this->diService->getContent();
    }
}
