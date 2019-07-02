<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ParserShopFactory;

class XParser extends Controller
{
    //
    public function parse(Request $request)
    {
        $shop = $request->shop;
        $isbn = $request->isbn;

        $parser = ParserShopFactory::build($shop);
        $parser->setList($isbn);
        $parser->parseISBN();
        return json_encode(["isbn"=>$isbn,"shop"=>$shop,"json"=>$parser->generateJSON()]);
    }
}
