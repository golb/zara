<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Files as Files;
use Illuminate\Support\Facades\Storage;

class DownloadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $file;
    
    public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Files $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = $this->file;
        $url = $file->url;
        
        $file->status = 'downloading';
        $file->save();
        
        $contents = file_get_contents($url);        

        $name = substr($url, strrpos($url, '/') + 1);

        Storage::disk('local')->put('public/'.$name, $contents);
        
        if (Storage::disk('local')->exists('public/'.$name)) {
            $file->download = 'public/'.$name;
            $file->status = 'complete';
            $file->save();
        } 
    }
    
    public function failed() {
        $file = $this->file;
        $file->status = 'error';
        $file->save();
    }
}
