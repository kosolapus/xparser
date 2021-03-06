<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use  App\Http\Controllers\UrlParseController;
use  App\Http\Controllers\XpathParseController;

use App\Events\NewBookAcceptToParseNotification;

class ParseUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $link_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($link_id)
    {
        //
        $this->link_id=$link_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        $link = UrlParseController::get($this->link_id);
        $xpath = XpathParseController::get($link->task_parses_id);

        //html is not valid xml. we know it. we doesn't need to repeat it. don't worry, dear php
        error_reporting(1);
        $xpath_array = $xpath->toArray();


        $url =  trim(preg_replace('/\s\s+/', ' ', $link->url));
        $result = [];

        $doc = new \DOMDocument();
        $doc->loadHTML(file_get_contents($url));
        $xpath = new \DOMXpath($doc);
        foreach ($xpath_array as $elem) {
            $elements = $xpath->query($elem["xpath_value"]);
            //print $doc->saveHTML();
            if (!is_null($elements)) {
                foreach ($elements as $element) {
                    $nodes = $element->childNodes;
                    foreach ($nodes as $node) {
                        $result[$elem["xpath_name"]][] = $node->nodeValue;
                    }
                }
            }
        }
        $link_parts = explode(".", $url);
        $link_parts =  explode("//", $link_parts[0]);
        $result["link"] = $link_parts[1];

        logger($result);

        event(new NewBookAcceptToParseNotification($result));
        UrlParseController::saveResult(json_encode($result), $this->link_id);
    }
}
