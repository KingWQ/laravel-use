<?php

namespace App\Http\Controllers;


class CollectController extends Controller
{
    public function index()
    {
        //1：获取所有的键或值 keys()、values()
        $collection = collect([
            'prod-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
            'prod-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
        ]);
        $collection->keys()->dump();
        $collection->values()->dump();

        //2：获取指定的键对应的值，第二参数指定生成集合的键 pluck()
        $collection->pluck('name')->dump();
        $collection->pluck('name','product_id')->dump();

        //2：获取特定的键值only, except
        $collection = collect(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);
        $collection->only(['product_id', 'name'])->dump();
        $collection->except(['product_id', 'name'])->dump();

        //14:filter()使用给定的回调函数过滤集合，没有回调函数，集合中所有返回false的元素移除
        $collection = collect([1, 2, 3, null, false, '', 0, []]);
        dump($collection->filter()->all());

        //3：最后一个last(), first() 前面两条take(2)
        dump(collect([1,2,3,4])->last());
        collect([1,2,3,4])->take(2)->dump();

        //7: 数组加逗号变成字符串implode()
        $collection = collect([
            ['account_id'=>1, 'product'=>'Desk'],
            ['account_id'=>2, 'product'=>'Chair'],
        ]);
        dump($collection->implode('product',','));
        dump(collect([1,2,3,4])->implode('-'));

        //8：聚合运算：count,sum,max,min,average

        //9：查找判断是否有值contains()，是否有键has()
        $collection = collect(['product' => 'Desk', 'price' => 200]);
        dump($collection->contains('Desk'));
        dump($collection->contains('Bookcase'));
        dump($collection->has('product'));
        dump($collection->has('book'));

        //10:判断集合是否为空isEmpty()
        dump(collect([])->isEmpty());
        dump(empty(collect([])));

        //11:each()循环集合, map()循环修改集合项并返回
        $collection = collect([1, 2, 3, 4, 5]);
        $temp = $collection->map(function ($item,$key){
            return $item*2;
        });
        dump($temp->all());

        //12:keyBy()指定键作为集合的键
        $collection = collect([
            ['product_id' => 'prod-100', 'name' => 'Desk'],
            ['product_id' => 'prod-200', 'name' => 'Chair'],
        ]);
        $collection->keyBy('product_id')->dump();

        //13:groupBy()根据指定键对集合项进行分组
        $collection = collect([
            ['account_id' => 'account-x10', 'product' => 'Chair'],
            ['account_id' => 'account-x10', 'product' => 'Bookcase'],
            ['account_id' => 'account-x11', 'product' => 'Desk'],
        ]);
        $grouped = $collection->groupBy('account_id');
        dump($grouped->toArray());

        //15:flip()集合的键和对应的值进行互换
        $collection = collect(['name' => 'taylor', 'framework' => 'laravel']);
        $fliped = $collection->flip();
        dump($fliped->all());

        //16: combine()将一个集合的值作为键，与另一个数组或集合的值进行结合
        $collection = collect(['name', 'age']);
        $combined = $collection->combine(['Mike',29]);
        dump($combined->all());

        //17：crossJoin()交叉连接指定数组或集合的值，返回所有可能排列的笛卡尔积
        $collection = collect(['S', 'M', 'L', 'XL', '2XL']);
        $matrix = $collection->crossJoin(['red', 'white', 'black']);
        dump($matrix->all());

    }
}
