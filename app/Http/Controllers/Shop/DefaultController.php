<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\TaskParseController;
use App\Http\Controllers\XpathParseController;

use App\Contracts\IParserShop;

use App\Jobs\ParseLinksFile;
use App\Jobs\CreateResultFile;
use App\Jobs\EmailResult;


class DefaultController extends Controller implements IParserShop
{
    //
    private $list;
    private $json;

    public function setList($list = null){
      $this->list[] = $list;
    }
    public function parseISBN(){}
    public function generateJSON(){}
}
