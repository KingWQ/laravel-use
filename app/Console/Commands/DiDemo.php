<?php

namespace App\Console\Commands;

use App\Http\Controllers\DiController;
use App\Services\Di\DiIoc;
use App\Services\Di\DiManual;
use App\Services\Di\DiNo;
use App\Services\Di\DiService;
use App\Services\Di\IocContainer;
use App\Services\Di\Iphone11;
use App\Services\Di\XiaoMing;
use Illuminate\Console\Command;

class DiDemo extends Command
{
    protected $signature = 'demo:di';
    protected $description = '依赖注入demo';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        /**
         * 1:普通模式 没有控制反转、依赖注入
         * 生活比喻
         * 依赖：我要吃面包，面包需要依赖面粉才能制作
         * 注入：买面粉 -> 加水 -> 制作面包 -> 吃
         * 控制：我控制面包的制作
         * 反转：无
         */
        $res1 = (new DiNo())->index();
        $this->info($res1);

        /**
         * 2:手动模式 控制反转 依赖注入
         * 生活比喻
         * 依赖：我要吃面包，依赖面包店
         * 注入：告诉面包店老板要吃什么 -> 老板给你(注入) -> 吃
         * 控制：面包店老板控制面包的制作
         * 反转：原来我控制面包的制作的权利没有了，转移给了面包店的老板
         */
        $diService = new DiService();
        $res2 = (new DiManual($diService))->index();
        $this->info($res2);


        /**
         * 3:IOC容器自动注入
         * 如何注入？使用php提供的反射功能。
         * 需要注入哪里的参数？依赖注入是以构造函数的形式传入，所以我们需要自动注入构造函数指定的参数。
         * 需要注入哪些参数？只注入类实例，其他参数原样传入。
         */
        $instance = IocContainer::autoInjectNew(DiIoc::class);
        $res3 = $instance->index();
        $this->info($res3);

        /**
         * 4: 系统自带的容器
         */
        $res4 = app(DiIoc::class)->index();
        $this->info($res4);

        return;
        $xiaoMing = new XiaoMing();
        $xiaoMing->read();
        $xiaoMing->play();
        $xiaoMing->grab();

        $phone = new Iphone11();
//        if($phone->isBroken()){
//            $phone = new Iphone6();
//        }
        $xiaoMing = new XiaoMing();
        $xiaoMing->read();
        $xiaoMing->play();
        $xiaoMing->grab();
    }
}
