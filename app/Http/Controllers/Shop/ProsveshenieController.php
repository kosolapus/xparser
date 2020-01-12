<?php

namespace App\Http\Controllers\Shop;


class ProsveshenieController extends DefaultController
{
  protected $xpath = "//span[contains(@class,'actual-price')]";
  protected $link_prefix = "https://shop.prosv.ru/search?q=";
  protected $link_postfix = "";

  public function parseISBN()
  {
      $this->json[] = 0;
  }
}
