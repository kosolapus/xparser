<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class Book24Controller extends DefaultController
{
    protected $xpath = "//*[@class='item-actions__price'][1]/b";
    protected $link_prefix = "https://book24.ru/search/?q=";
    protected $link_postfix = "";
}
