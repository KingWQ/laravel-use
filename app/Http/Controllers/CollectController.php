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

        //3：最后一个last(), 前面两条take(2)
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

        //11:遍历each(), map()

        //12:keyBy('id')把id当做键

        //13:groupBy()分组

        //14:filter()筛选

        //15:flip() key和value互换

        //16: combine() 把一个集合当做key,另一个集合当做value

        //17：crossJoin()生成笛卡尔集


    }
}
