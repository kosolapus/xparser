<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

use App\Http\Controllers\TaskParseController;
use App\Http\Controllers\XpathParseController;

use App\Jobs\ParseLinksFile;
use App\Jobs\CreateResultFile;
use App\Jobs\EmailResult;

class IsbnToParseJsonController extends Controller
{
    public function index(Request $request)
    {

      //prepare url list for each store
        //create task
        $task = TaskParseController::add("kosolapus@gmail.com");

        $isbnlist = $request->input("isbn");

        $book24 = IsbnToParseJsonController::book24($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $book24["links"]));
        //create new XPath

        XpathParseController::add("isbn", $book24["isbn"], $task->id);
        XpathParseController::add("title", $book24["title"], $task->id);
        XpathParseController::add("price", $book24["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);

        $task = TaskParseController::add("kosolapus@gmail.com");

        $isbnlist = $request->input("isbn");

        $prosvet = IsbnToParseJsonController::prosvet($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $prosvet["links"]));
        //create new XPath

        XpathParseController::add("isbn", $prosvet["isbn"], $task->id);
        XpathParseController::add("title", $prosvet["title"], $task->id);
        XpathParseController::add("price", $prosvet["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);

        $task = TaskParseController::add("kosolapus@gmail.com");

        $labirint = IsbnToParseJsonController::labirint($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $labirint["links"]));
        //create new XPath

        XpathParseController::add("isbn", $labirint["isbn"], $task->id);
        XpathParseController::add("title", $labirint["title"], $task->id);
        XpathParseController::add("price", $labirint["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);

        $task = TaskParseController::add("kosolapus@gmail.com");

        $myshop = IsbnToParseJsonController::myshop($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $myshop["links"]));
        //create new XPath

        XpathParseController::add("isbn", $myshop["isbn"], $task->id);
        XpathParseController::add("title", $myshop["title"], $task->id);
        XpathParseController::add("price", $myshop["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);

        $task = TaskParseController::add("kosolapus@gmail.com");

        $prosvet = IsbnToParseJsonController::prosvet($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $prosvet["links"]));
        //create new XPath

        XpathParseController::add("isbn", $prosvet["isbn"], $task->id);
        XpathParseController::add("title", $prosvet["title"], $task->id);
        XpathParseController::add("price", $prosvet["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);

        $task = TaskParseController::add("kosolapus@gmail.com");

        $abris = IsbnToParseJsonController::abris($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $abris["links"]));
        //create new XPath

        XpathParseController::add("isbn", $abris["isbn"], $task->id);
        XpathParseController::add("title", $abris["title"], $task->id);
        XpathParseController::add("price", $abris["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);

        $task = TaskParseController::add("kosolapus@gmail.com");

        $ozon = IsbnToParseJsonController::ozon($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $ozon["links"]));
        //create new XPath

        XpathParseController::add("isbn", $ozon["isbn"], $task->id);
        XpathParseController::add("title", $ozon["title"], $task->id);
        XpathParseController::add("price", $ozon["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);

        $task = TaskParseController::add("kosolapus@gmail.com");

        $chg = IsbnToParseJsonController::chg($isbnlist);
        //save files for work
        Storage::disk('local')->put("/links/"."work_".$task->id, implode("\r\n", $chg["links"]));
        //create new XPath

        XpathParseController::add("isbn", $chg["isbn"], $task->id);
        XpathParseController::add("title", $chg["title"], $task->id);
        XpathParseController::add("price", $chg["price"], $task->id);
        ParseLinksFile::dispatch("links/work_", $task->id);
        CreateResultFile::dispatch($task->id);
    }
    public static function book24(String $isbnlist = "")
    {
        //$isbnlist = $request->has("isbn")?$request->isbn:"";

        $ret = [
        "title"=>"//*[@class='item-detail__title']",
        "price"=>"//*[@class='item-actions__price'][1]/b",
        "isbn" => "//div[@class='item-detail__informations-box']//input[contains(@class, 'isbn__code')]/@value"
      ];
        foreach (explode("\n", $isbnlist) as $isbn) {
            $ret["links"][] = "https://book24.ru/search/?q=".$isbn;
        }
        //print(file_get_contents($ret["links"][0])); die;
        return collect($ret);
    }

    public static function labirint(String $isbnlist)
    {
        $ret = [
        "title"=>"//meta[@property='og:title']/@content",
        "price"=>"//*[contains(@class,'buying-price-val-number') or contains(@class,'buying-pricenew-val-number')]",
        "isbn"=>"//*[@class='isbn']"
      ];
        foreach (explode("\n", $isbnlist) as $isbn) {
            $ret["links"][] = "https://labirint.ru/search/".$isbn."/?labsearch=1&stype=0";
        }
        return collect($ret);
    }

    public static function myshop(String $isbnlist)
    {
        $ret = [
        "title"=>"//*[@style='padding-bottom: 4px']/a/b",
        "price"=>"//*[@style='font-size:14px']",
        "isbn"=>"//*[@class='search_h1']"
      ];
        foreach (explode("\n", $isbnlist) as $isbn) {
            $ret["links"][] = "https://my-shop.ru/shop/search/a/sort/z/page/1.html?f14_6=".$isbn;
        }
        return collect($ret);
    }

    public static function prosvet(String $isbnlist)
    {
        $ret = [
        "title"=>"//*[@class='product-title']/a/text()",
        "price"=>"//*[contains(@class,'price') and contains(@class,'actual-price')]/text()",
        "isbn"=>"//*[contains(@class,'search-text')]/@value"
      ];
        foreach (explode("\n", $isbnlist) as $isbn) {
            $ret["links"][] = "https://shop.prosv.ru/search?q=".$isbn;
        }
        return collect($ret);
    }

    public static function abris(String $isbnlist)
    {
        $ret = [
        "title"=>"//div[contains(@class,'card__property')]/*[contains(@class,'name')]/text()",
        "price"=>"//div[contains(@class,'price')]/*[contains(@class,'active')]/text()",
        "isbn"=>"//input[contains(@id,'title-search-input')]/@value"
      ];
        foreach (explode("\n", $isbnlist) as $isbn) {
            $ret["links"][] = "https://tdabris.ru/catalog/?q=".$isbn."&where=isbn";
        }
        return collect($ret);
    }

    public static function ozon(String $isbnlist)
    {
        $ret = [
        "title"=>"//a[contains(@class,'name')]/text()",
        "price"=>"//*[contains(@class,'total-price')]/text()",
        "isbn"=>"//*[contains(@class,'crosslink')]//b"
      ];
        foreach (explode("\n", $isbnlist) as $isbn) {
            $ret["links"][] = "https://ozon.ru/search/?from_global=true&text=".$isbn."";
        }
        return collect($ret);
    }

    public static function chg(String $isbnlist)
    {
        $ret = [
        "title"=>"//*[contains(@class,'container_cards-product')]//div[contains(@class,'product-card__title')]/text()",
        "price"=>"//*[contains(@class,'container_cards-product')]//span[contains(@class,'price')]/text()",
        "isbn"=>"//*[contains(@class,'search-form__input')]/@value"
      ];
        foreach (explode("\n", $isbnlist) as $isbn) {
            $ret["links"][] = "https://chitai-gorod.ru/search/result/?q=".$isbn."&page=1";
        }
        return collect($ret);
    }
}
