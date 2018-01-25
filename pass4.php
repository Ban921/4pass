<?php

namespace pass4;

class pass4
{
    public $url;


    public $global_uid = [1, 2, 3, 4, 5, 6, 7, 8];
    public $online = [];
    public $onlinegame = [];
    public $raisenum = [];
    public $tablemoney = 0;
    public $yesnum = 0;
    public $gameing = 0;
    public $time = 20;

    public function _(Type $var = null)
    {
        if($url == '123'){
            $this->createpoker;
        }
    }
    public function createpoker()
    {
        for ($i = 1; $i <= 52; $i++) {
            $poker[$i] = $i;
        }
    }
}


$poker1 = new pass4();

print_r($poker1->createpoker());