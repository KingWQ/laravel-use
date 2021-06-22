<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//数据库操作2：查询构造器
class DbQueryController extends Controller
{
    public function select()
    {
        //查询
        $users = DB::table('users')->where('id', 1)->get();       //返回集合
        $users = DB::table('users')->find(1);       //返回对象
        $users = DB::table('users')->where('id', 1)->first();    //返回对象
        $users = DB::table('users')->where('id', 1)->value('name');
        $users = DB::table('users')->pluck('email');

        //分页
        $users = DB::table('users')->paginate();
        $users = DB::table('users')->simplePaginate();

        //聚合
        $max   = DB::table('users')->max('id');
        $min   = DB::table('users')->min('id');
        $avg   = DB::table('users')->avg('id');
        $count = DB::table('users')->count('id');
        $sum   = DB::table('users')->sum('id');

        //是否存在
        $exist   = DB::table('users')->where('id', 1)->exists();
        $noExist = DB::table('users')->where('id', 10)->doesntExist();
    }

    //where语句使用
    public function whereUse()
    {
        //where * from users where id<1;
        DB::table('users')->where('id','>', 1)->dump();

        //where * from users where id<>1;
        DB::table('users')->where('id','<>', 1)->dump();
        DB::table('users')->where('id','!=', 1)->dump();

        //where * from users where name like 'test%';
        DB::table('users')->where('name','like', 'test%')->dump();
        //where * from users where id<1 or name like 'test%';
        DB::table('users')->where('id','>', 1)->orWhere('name','like', 'test%')->dump();
        //where * from users where id<1 and (email like '%@163' or name like 'test%');
        DB::table('users')->where('id','>', 1)->where(function(Builder $query){
                $query->where('email','like', '%@163')
                    ->orWhere('name','like', 'test%');
            })->dump();

        //where * from users where id in (1,3);
        //where * from users where id not in (1,3);
        DB::table('users')->whereIn('id', [1,3])->dump();
        DB::table('users')->whereNotIn('id', [1,3])->dump();

        //where * from users where created_at is null;
        //where * from users where created_at is not null;
        DB::table('users')->whereNull('created_at')->dump();
        DB::table('users')->whereNotNull('created_at')->dump();

        //where * from users where `name` = `email`; 比较两个字段
        DB::table('users')->whereColumn('name', 'email')->dump();
    }

    //新增
    public function addUpdateDelete()
    {
        DB::table('users')->insert([
            'name'=>'halo',
            'password'=>Hash::make('123456'),
            'email'=>'halo@163.com'
        ]);
        DB::table('users')->insertGetId([
            'name'=>'php',
            'password'=>Hash::make('123456'),
            'email'=>'php@163.com'
        ]);

        DB::table('users')->updateOrInsert(['id'=>7],['name'=>'halo']);

    }
}
