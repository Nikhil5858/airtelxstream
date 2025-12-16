<?php

class OtpHelper
{
    public static function generate(): string
    {
        return (string) random_int(1000, 9999);
    }

    public static function expiresAt(): string
    {
        return date('Y-m-d H:i:s', strtotime('+5 minutes'));
    }
}
