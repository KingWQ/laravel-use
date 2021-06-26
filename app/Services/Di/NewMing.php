<?php


namespace App\Services\Di;


class NewMing
{
    private $_name;
    private $_age;
    private $_phone;

    public function __construct($phone)
    {
        $this->_name  = '小明';
        $this->_age   = 26;
        $this->_phone = $phone;
        echo "新小明起床了".PHP_EOL;
    }

    //逛知乎
    function read()
    {
        $this->_phone->read($this->_name);
    }

    //玩农药
    function play()
    {
        $this->_phone->play($this->_name);
    }

    //抢红包
    function grab()
    {
        $this->_phone->grab($this->_name);
    }

}
