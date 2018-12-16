<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

class DownloadTest extends TestCase
{
    use RefreshDatabase;
    
    public function testIndexPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function testFileDownload()
    {
        Storage::fake('local');
        
        $response = $this->json('POST', '/download', [
            'file' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        // Assert the file was stored...
        Storage::disk('local')->assertExists('avatar.jpg');

        // Assert a file does not exist...
        Storage::disk('local')->assertMissing('missing.jpg');
    }
    
    public function test_console_command()
    {
        $this->artisan('download:url someUrl')
            ->expectsOutput('File: '.someUrl.' added to queue. Dont forget run Queue Listener for complete download task.')
            ->assertExitCode(0);
    }
}
