<?php


namespace App\Services\Encryption;


class Encrypt
{
    private $_encrypt;

    /**
     * Encrypt constructor.
     * @param IEncrypt $_encrypt
     */
    public function __construct(IEncrypt $_encrypt)
    {
        $this->_encrypt = $_encrypt;
    }

    public function encryption(): IEncrypt
    {
        return $this->_encrypt;
    }

}
