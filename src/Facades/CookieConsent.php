<?php


namespace Retinens\CookieConsent\Facades;


class CookieConsent extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cookie-consent';
    }
}
