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

    /**
     * display the Main view
     */
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

    /**
     * @param $file
     * Make encrypt for file data
     */
    private function encrypt($file): void{
        $fileContent = file_get_contents($file);
        file_put_contents($file,$this->_encrypt->encryption()->encrypt($fileContent));
    }

    /**
     * @param $file
     * make decrypt for file data
     */
    private function decrypt($file){
        $fileContent = file_get_contents($file);
        file_put_contents($file,$this->_encrypt->encryption()->decrypt($fileContent));
    }

    /**
     * @param Request $request
     * copy file from server to hard disk
     */
    public function download(Request $request){
        $file = $request->file;
        $exe = substr(basename($file), strrpos(basename($file),'.') + 1);
        $path = $request->location;
        $name = $request->name.'.'.$exe;
        copy($file, $path.'\\'.$name);
        die('file downloaded to your location');
    }
}
