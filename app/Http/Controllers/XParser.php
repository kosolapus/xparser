<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XParser extends Controller
{
    //
    public function parse(Request $request){
      error_reporting(0);
      $xpath_array = ["value"=>$request->input("xpath")];

        $url_array = [$request->input("link")];

        $result = [];

        foreach($url_array as $url){
          $doc = new \DOMDocument();
          $doc->loadHTML(file_get_contents($url));
          $xpath = new \DOMXpath($doc);
          foreach($xpath_array as $name=>$query){
            $elements = $xpath->query($query);

            //print $doc->saveHTML();

            if (!is_null($elements)) {
              foreach ($elements as $element) {
                $nodes = $element->childNodes;
                foreach ($nodes as $node) {
                  $result[$name][] = $node->nodeValue;
                }
              }
            }
          }

        }
        foreach($result as $title=>$item){
          print "<h2>".$title."</h2>";
          print implode("<br>", $item);
        }
    }
}
