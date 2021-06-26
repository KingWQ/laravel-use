<?php


namespace App\Services\Di;


class XiaoMing
{
    private $_name;
    private $_age;

    public function __construct()
    {
        $this->_name = '小明';
        $this->_age = 26;
    }

    //逛知乎
    function read()
    {
        (new Iphone6())->read($this->_name);
    }

    //玩农药
    function play()
    {
        (new Iphone6())->play($this->_name);
    }

    //抢红包
    function grab()
    {
        (new Iphone6())->grab($this->_name);
    }

}
