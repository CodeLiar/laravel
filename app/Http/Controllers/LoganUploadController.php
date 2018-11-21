<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoganUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $extension = $photo->extension();
            //$store_result = $photo->store('photo');
            $store_result = $photo->storeAs('photo', 'test.jpg');
            $filename = $photo->getFilename();
            $output = [
                'extension' => $extension,
                'filename' => $filename,
                'store_result' => $store_result
            ];
            print_r($output);exit();
        }
        exit('未获取到上传文件或上传过程出错');
    }

    public function uploadFile(Request $request) {
        Log::info('dmj --> laravel_log');
        $content = $request->getContent();
	    var_dump($content);
        $this->decode($content, 0);
        return $content;
    }

    private function decode($buf, $skips) {
        if ($skips < strlen($buf)) {
            $start = ord($buf[$skips]);
            $skips ++;
            if ($start == 1) {
                $contentLen = (((ord($buf[skips])) & 0xFF) << 24) | (((ord($buf[skips+1])) & 0xFF) << 16)  | (((ord($buf[skips+2])) & 0xFF) << 8) | ((ord($buf[skips+3])) & 0xFF);
                $skips += 4;
                $skips += $contentLen;
                Log::info('dmj --> contentLen --> '. $contentLen);
                $this->decode($buf, $skips);
            } else {
                $this->decode($buf, $skips);
            }
        }
    }
}
