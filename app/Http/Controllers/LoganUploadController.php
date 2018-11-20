<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoganUploadController extends Controller
{
    public function upload(Request $request)
    {
        return $request.get('body');
    }
}
