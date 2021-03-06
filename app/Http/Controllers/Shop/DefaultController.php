<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    //test on labirint
    protected $isbn;
    protected $json;
    protected $price;
    protected $xpath = "//*[contains(@class,'buying-price-val-number') or contains(@class,'buying-pricenew-val-number')]";
    protected $link_prefix = "https://labirint.ru/search/";
    protected $link_postfix = "/?labsearch=1&stype=0";


    public function setList($isbn = null)
    {
        $this->isbn = $isbn;
    }
    public function parseISBN()
    {
        //html is not valid xml. we know it. we doesn't need to repeat it. don't worry, dear php
        error_reporting(1);

        $link = $this->link_prefix.$this->isbn.$this->link_postfix;

        $doc = new \DOMDocument();

        $loadSettings =  array(
            'http' => array(
                'proxy' => 'tcp://192.168.0.1:3128',
                'request_fulluri' => true,
            ),
        );

        $cxContext = stream_context_create($loadSettings);

        $doc->loadHTML(file_get_contents($link, false, $cxContext));

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
        return intval(preg_replace("/[^0-9.,]/", "",$this->json[0]));

    }
}
