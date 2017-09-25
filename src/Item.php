<?php

namespace Omnipay\Gerencianet;

use Omnipay\Common\Helper;

class Item
{
    public $helper;
    
    public function __construct()
    {
        $this->helper = new Helper();
    }
}
