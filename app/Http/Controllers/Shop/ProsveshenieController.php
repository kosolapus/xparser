<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class ProsveshenieController extends DefaultController
{
  protected $xpath = "//span[contains(@class,'actual-price')]";
  protected $link_prefix = "https://shop.prosv.ru/search?q=";
  protected $link_postfix = "";
}
