<?php


namespace App\Services;


class UploadService
{

    public static function upload($file){

        $exe = $file->getClientOriginalExtension();
        $size = $file->getSize();

        //Move Uploaded File
        $destinationPath = 'uploads/';
        $fileName = date('Y-m-d H:i:s').$file->getClientOriginalName();
        $file->move($destinationPath,$fileName);

        return [
            'name' => $file->getClientOriginalName(),
            'size' =>$size,
            'exe' => $file->getClientOriginalExtension(),
            'path' => $destinationPath.$fileName
        ];
    }

}
