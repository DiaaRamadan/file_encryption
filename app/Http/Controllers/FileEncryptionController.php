<?php

namespace App\Http\Controllers;

use App\Services\Encryption\Encrypt;
use App\Services\Encryption\OpenSSL;
use App\Services\UploadService;
use Illuminate\Http\Request;

class FileEncryptionController extends Controller
{
    private $_encrypt;
    public function __construct(){
        $this->_encrypt = new Encrypt(new OpenSSL());
    }
    public function index(){
      return view('encryptView');
    }

    public function doOperation(Request $request){
        try {
            $fileData = UploadService::upload($request->file('file'));
            if ($request->type == 1) {
                $this->encrypt($fileData['path']);
            } else {
                $this->decrypt($fileData['path']);
            }
            return view('encryptDetails', compact('fileData'));
        }catch (\Exception $exception){
            die('Can not access file');
        }
    }

    private function encrypt($file): void{
        $fileContent = file_get_contents($file);
        file_put_contents($file,$this->_encrypt->encryption()->encrypt($fileContent));
    }

    private function decrypt($file){
        $fileContent = file_get_contents($file);
        file_put_contents($file,$this->_encrypt->encryption()->decrypt($fileContent));
    }

    public function download(Request $request){

        $file = $request->file;
        $exe = substr(basename($file), strrpos(basename($file),'.') + 1);
        $name = $request->name.'.'.$exe;
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$name.'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

}
