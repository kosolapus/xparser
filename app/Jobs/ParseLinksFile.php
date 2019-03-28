<?php

namespace App\Jobs;

use Storage;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Http\Controllers\UrlParseController;

use App\Jobs\ParseUrl;
use App\Jobs\DeleteLinksFile;


class ParseLinksFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $task_id;
    private $filesalt;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(String $filesalt, String $task_id)
    {
        //
        $this->task_id = $task_id;
        $this->filesalt = $filesalt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $file = new \SplFileObject(Storage::path($this->filesalt.$this->task_id) );

        // Loop until we reach the end of the file.
        $wait=0;
        while (!$file->eof()) {
            // One link - one line
            $link = $file->fgets();
            //base validation link: hhtp(s)://*.*
            //$regex = "/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/";
            if(preg_match("/[^(\w)|(\@)|(\.)|(\-)]/",$link)>0){
              //if it's a link - we add link into database and start parsing
              $link = UrlParseController::add($link,$this->task_id);
              ParseUrl::dispatch($link->id)->delay(now()->addSeconds($wait));
            }
        }

        // Unset the file to call __destruct(), closing the file handle.
        $file = null;
    }
}
