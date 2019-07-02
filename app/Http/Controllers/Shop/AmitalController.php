<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class AmitalController extends DefaultController
{
    //Работает не совсем корректно, не учитывает отсутствующие ISBN
    protected $xpath = "//div[contains(@class,'price-list')]/table/tr/td[3]/strong";
    protected $link_prefix = "https://amital.ru/product/search.html?wildcard=true&search=";
    protected $link_postfix = "";
}
