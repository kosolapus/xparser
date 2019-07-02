<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contracts\IParserShop;

class DefaultController extends Controller implements IParserShop
{
    //test on labirint
    protected $isbn;
    protected $json;
    protected $price;
    protected $xpath = "//*[contains(@class,'buying-price-val-number') or contains(@class,'buying-pricenew-val-number')]";

    public function setList($isbn = null)
    {
        $this->isbn = $isbn;
    }
    public function parseISBN()
    {
        //html is not valid xml. we know it. we doesn't need to repeat it. don't worry, dear php
        error_reporting(1);

        $link = "https://labirint.ru/search/".$this->isbn."/?labsearch=1&stype=0";

        $doc = new \DOMDocument();

        $doc->loadHTML(file_get_contents($link));
        $xpath_doc = new \DOMXpath($doc);
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
    public function generateJSON()
    {
        return intval($this->json[0]);
    }
}
