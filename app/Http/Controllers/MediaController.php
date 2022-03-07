<?php

namespace App\Http\Controllers;

use App\Jobs\SaveImagesCdnJob;

class MediaController extends Controller
{
    public function index()
    {
        
        $imagesToCdn = new SaveImagesCdnJob();
        dispatch($imagesToCdn);
        die();
    }
}
