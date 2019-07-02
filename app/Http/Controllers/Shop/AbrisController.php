<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class AbrisController extends DefaultController
{
  protected $xpath = "//div[@class='active']";
  protected $link_prefix = "https://www.tdabris.ru/catalog/?q=";
  protected $link_postfix = "&where=isbn&s=";
  
}
