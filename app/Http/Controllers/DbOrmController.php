<?php

namespace App\Http\Controllers;


//数据库操作3: ORM
use App\Models\Product;

class DbOrmController extends Controller
{
    public function add()
    {
        $product = Product::query()->create([
            'title'=>'钢笔',
            'category_id'=>1,
            'is_on_sale'=>1,
            'price'=>10000,
            'attr'=>['brand'=>'英雄','color'=>'蓝色'],
        ]);
        dump($product);

        $ret = Product::query()->insert([
            'title'=>'鼠标',
            'category_id'=>2,
            'is_on_sale'=>1,
            'price'=>8000,
            'attr'=>json_encode(['brand'=>'双飞燕','color'=>'黑色']),
        ]);
        dump($ret);

        $product = new Product();
        $product->fill([
            'title'=>'钢笔',
            'category_id'=>1,
            'is_on_sale'=>1,
            'price'=>10000,
            'attr'=>['brand'=>'英雄','color'=>'蓝色'],
        ]);
        $product->save();
        dd($product);

    }
}
