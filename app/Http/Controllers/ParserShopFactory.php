<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Shop\DefaultController;

class ParserShopFactory extends Controller
{
    //
    public function _construct(){

    }

    public static function build($type=''){
      if($type == '') {
            throw new \Exception('Invalid Parser Type.');
        } else {

            $className = 'App\\Http\\Controllers\\Shop\\'.ucfirst($type).'Controller';

            // Assuming Class files are already loaded using autoload concept
            if(class_exists($className)) {
                return new $className();
            } else {
              $className = 'App\\Http\\Controllers\\Shop\\DefaultController';
              return new $className();
            }
        }

    }
}
