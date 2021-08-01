<?php


namespace App\Services\Encryption;


class OpenSSL implements IEncrypt
{
    private $cipherAlgo = 'AES-256-CBC';
    private $privateKey = 'MYCRYPT0K3Y@2021';
    private $secret_iv = 'This is my secret iv';

    public function __construct(){

    }

    public function encrypt($data)
    {
        return openssl_encrypt($data, $this->cipherAlgo,
            $this->privateKey, 0, $this->createIV());
    }

    public function decrypt($data)
    {
        return openssl_decrypt($data, $this->cipherAlgo, $this->privateKey,0, $this->createIV());
    }

    private function createIV(){
        return substr(hash('sha256', $this->secret_iv), 0,
            openssl_cipher_iv_length($this->cipherAlgo));
    }
}
