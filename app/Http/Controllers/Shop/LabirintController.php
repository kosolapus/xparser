<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class LabirintController extends DefaultController
{
  //Хей-хо, стандартный контроллер построен на нем же)
  protected $xpath = "//*[contains(@class,'buying-price-val-number') or contains(@class,'buying-pricenew-val-number')]";
  protected $link_prefix = "https://labirint.ru/search/";
  protected $link_postfix = "/?labsearch=1&stype=0";
}
