<?php

namespace App\Jobs;

use Storage;
use URL;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


use App\Parser\UrlParse;
use App\Parser\TaskParse;
use App\Jobs\EmailResult;

class CreateResultFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $task_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task_id)
    {
        //
        $this->task_id = $task_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $url_object = UrlParse::where("task_parses_id",$this->task_id)->get();

        $result_array = [];
        foreach($url_object as $elem){
          $result_array[] = json_decode($elem->json_result);
        }
        Storage::disk('local')->put("/result/".$this->task_id.".json", json_encode($result_array));

        $task = TaskParse::find($this->task_id);



        //EmailResult::dispatch($task);
    }
}
