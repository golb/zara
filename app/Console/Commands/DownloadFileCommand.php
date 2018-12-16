<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Files;
use App\Jobs\DownloadFile;

class DownloadFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:url {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'downloaded file by url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');
        
        $file = new Files;
        $file->url = $url;
        $file->save();
        
        DownloadFile::dispatch($file);
        
        $this->call('files:list');
        
        $this->info("File: {$url} added to queue. Dont forget run Queue Listener for complete download task.");
    }
}
