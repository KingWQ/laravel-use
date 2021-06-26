<?php

namespace App\Services\Di;

//IOC容器自动注入
class DiIoc
{
    public $diService;

    public function __construct(DiService $diService)
    {
        $this->diService = $diService;
    }

    public function index()
    {
        return 'IOC容器自动注入--'.$this->diService->getContent();
    }
}
