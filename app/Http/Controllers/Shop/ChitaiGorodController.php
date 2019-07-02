<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\DefaultController;

class ChitaiGorodController extends DefaultController
{
  protected $xpath = "";
  protected $link_prefix = "https://chitai-gorod.ru/search/result/?q=";
  protected $link_postfix = "";

  public function parseISBN()
  {
       $client = new \GuzzleHttp\Client();
       $url = "https://www.chitai-gorod.ru/search.php";

       $myBody['index'] = "goods";
       $myBody['query'] = $this->isbn;
       $myBody['type'] = "common";
       $myBody['from'] = "0";
       $myBody['per_page'] = "24";
       $myBody['filters[available]'] = "false";
       try{
         $response = $client->request('POST', $url,  ['form_params'=>$myBody]);
         $book = json_decode($response->getBody()->getContents());
         $price = $book->hits->hits[0]->_source->price;
         $this->json[]=$price;
       } catch (\Exception $e){
         $this->json[]=0;
       }
  }
}
