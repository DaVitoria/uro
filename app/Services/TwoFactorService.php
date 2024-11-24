<?php

namespace App\Services;

use PragmaRX\Google2FALaravel\Support\Authenticator;

class TwoFactorService
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = app('pragmarx.google2fa');
    }

    public function generateSecret()
    {
        return $this->google2fa->generateSecretKey();
    }

    public function generateQRCode($appName, $email, $secret)
    {
        return $this->google2fa->getQRCodeInline($appName, $email, $secret);
    }

    public function verifyCode($secret, $code)
    {
        return $this->google2fa->verifyKey($secret, $code);
    }
}
