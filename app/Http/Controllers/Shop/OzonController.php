<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class OzonController extends DefaultController
{
  protected $xpath = "//span[contains(@class,'total-price')]";
  protected $link_prefix = "https://www.ozon.ru/search/?text=";
  protected $link_postfix = "&from_global=true";
}
