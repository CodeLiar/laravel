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
        $this->decode($content, 0);
        return $content;
    }

    private function decode($buf, $skips) {
        if ($skips < strlen($buf)) {
            $start = ord($buf[$skips]);
            $skips ++;
            if ($start == 1) {
                $contentLen = (((ord($buf[$skips])) & 0xFF) << 24) | (((ord($buf[$skips+1])) & 0xFF) << 16)  | (((ord($buf[$skips+2])) & 0xFF) << 8) | ((ord($buf[$skips+3])) & 0xFF);
                $skips += 4;
                if ($skips + $contentLen > strlen($buf)) {
                    $skips -= 4;
                    $this->decode($buf, $skips);
                    return ;
                }
                $content = substr($buf, $skips, $contentLen);
                $skips += $contentLen;
                $decrypted = $this->decrypt($content);
                $file = "../../../storage/app/temp/enc_temp.gz";
                file_put_contents($file, $decrypted);
                unlink($file);

                $this->decode($buf, $skips);
            } else {
                $this->decode($buf, $skips);
            }
        }
    }

    public function decrypt($encrypted) {
        $method = "AES-128-CBC";
        $iv = "0123456789012345";
        $key = "0123456789012345";
        $options = OPENSSL_RAW_DATA | OPENSSL_NO_PADDING;
        $sign = @openssl_decrypt($encrypted, $method, $key, $options, $iv);
        $sign = $this->unPkcsPadding($sign);
        $sign = rtrim($sign);
        return $sign;
    }


    public function unPkcsPadding($str)
    {
        $pad = ord($str[strlen($str) - 1]);
        if ($pad > strlen($str)) {
            return false;
        }
        return substr($str, 0, -1 * $pad);
    }
}
