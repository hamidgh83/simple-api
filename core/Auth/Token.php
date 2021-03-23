<?php

namespace Core\Auth;

class Token
{
    public static function generate()
    {
        return bin2hex(openssl_random_pseudo_bytes(128));
    }

    public static function validate($token)
    {
        return true;
    }
}
