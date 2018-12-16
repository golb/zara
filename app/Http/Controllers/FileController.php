<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Files;
use App\Jobs\DownloadFile;

use Illuminate\Support\Facades\Storage; // todo

class FileController extends Controller
{    
    public function index(Request $request) {
        $files = Files::all();
        return view('welcome', ['files' => $files]);
    }
    
    public function api(Request $request) {
        return view('download');
    }
    
    public function download(Request $request) {        
        $file = new Files;
        $file->url = $request->input('file');
        $file->save();
        
        DownloadFile::dispatch($file);
        
        return Redirect::to('/');
    }
}
