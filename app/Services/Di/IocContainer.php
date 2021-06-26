<?php

namespace App\Services\Di;


class IocContainer
{
    public static function autoInjectNew($className, $params=[])
    {
        $reflect = new \ReflectionClass($className);

        //获取构造函数
        $construct = $reflect->getConstructor();

        //保存实例化需要的参数
        $args = [];
        if($construct){
            $constructParams = $construct->getParameters();
            foreach($constructParams as $item){
                $class = $item->getClass();
                if($class){
                    // $args[] = new $class->name();
                    // 如果这样处理依赖的的 UserService() 还有依赖的话则无法兼顾，所以需要递归处理

                    $args[] = self::autoInjectNew($class->name);
                }
            }
        }

        //合并参数
        $args = array_merge($args, $params);

        /**
         * Ioc控制反转
         * 控制：容器控制了对象的创建
         * 反转：创建对象的权利已经转移到容器来了
         * DI依赖注入
         * 依赖：$args保存了需要的依赖
         * 注入：把$args中的依赖作为作为参数传入，返回实例
         */
        $instance = $reflect->newInstanceArgs($args);

        return $instance;
    }
}
