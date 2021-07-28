<?php


namespace App\Services\Encryption;


interface IEncrypt
{
    public function encrypt($data);
    public function decrypt($data);

}
