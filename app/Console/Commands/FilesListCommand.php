<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Files;

class FilesListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output files and their statuses';

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
        $files = Files::all(['url', 'status', 'download'])->toArray();
        $headers = ['file url', 'status', 'local download url'];
        $this->table($headers, $files);
    }
}
