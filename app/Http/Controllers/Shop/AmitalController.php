<?php

namespace App\Http\Controllers\Shop;

class AmitalController extends DefaultController
{
    //Работает не совсем корректно, не учитывает отсутствующие ISBN
    protected $xpath = "//div[contains(@class,'final-price')]";
    protected $link_prefix = "https://amital.ru/product/search.html?wildcard=true&search=";
    protected $link_postfix = "";
}
