<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

//数据库操作1：原生查询
class DbSqlController extends Controller
{
    public function test()
    {
        //curd操作
        $ret   = DB::insert("insert into users (name, email, password) values (?, ?, ?)", [
            'huge',
            'huge@126.com',
            '123456'
        ]);
        dd($ret);
        $users = DB::select("select * from users");
        $users = DB::select('select * from users where id = ?', [1]);

        $ret = DB::update('update users set email = ? where id = ?', [
            'test@163.com',
            1
        ]);
        $ret = DB::delete('delete from users where id = ?', [1]);

        //表结构操作
        //DB::statement('truncate table users');
    }
}
