<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class MyShopController extends DefaultController
{
    //
    protected $xpath = "//*[@style='font-size:14px']";
    protected $link_prefix = "https://my-shop.ru/shop/search/a/sort/z/page/1.html?f14_6=";
    protected $link_postfix = "";
}
