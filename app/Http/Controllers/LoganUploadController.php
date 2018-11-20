<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoganUploadController extends Controller
{
    public function upload()
    {
        return "Hello World!";
        $file = $request->file('photo');
        var_dump($file);
    }
}
