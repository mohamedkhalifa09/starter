<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VideoViewer  $event): void
    {
        //

        if(!session()->has("videoIsVisited")){
         $this -> UpdateViewer($event -> video);
        }

    }

    public function UpdateViewer($video)
    {
      $video -> viewer =  $video -> viewer + 1 ;
   $video ->save() ; 
      session()->put("videoIsVisited",$video->id);
    }
}
