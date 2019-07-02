<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class AbrisController extends DefaultController
{
  protected $xpath = "//div[@class='active']";

  //978-5-00111-348-5
  public function parseISBN(){
      //html is not valid xml. we know it. we doesn't need to repeat it. don't worry, dear php
      error_reporting(1);

      $link = "https://www.tdabris.ru/catalog/?q=".$this->isbn."&where=isbn&s=";

      $doc = new \DOMDocument();

      $doc->loadHTML(file_get_contents($link));
      $xpath_doc = new \DOMXpath($doc);
      $xpath_doc->registerNamespace ("" , null );
      $elements = $xpath_doc->query($this->xpath);

      //print $doc->saveHTML();

      if (!is_null($elements)) {
          foreach ($elements as $element) {
              $nodes = $element->childNodes;

              foreach ($nodes as $node) {
                  $this->json[] = $node->nodeValue;
              }
          }
      }

  }

}
