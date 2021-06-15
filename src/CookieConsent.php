<?php


namespace Retinens\CookieConsent;

use Illuminate\Support\Facades\Cookie;

class CookieConsent
{
    private bool $userHasConsented;

    public function __construct()
    {
        $cookieConsentConfig = config('cookie-consent');

        $dismissedTheAlert = Cookie::has($cookieConsentConfig['cookie_name']);
        $hasConsented = false;
        if ($dismissedTheAlert) {
            $cookie = Cookie::get(config('cookie-consent.cookie_name'));
            if (is_string($cookie)) {
                $hasConsented = $cookie == "1";
            } else {
                $hasConsented = $cookie->getValue() == "1";
            }
        }
        $this->userHasConsented = $dismissedTheAlert && $hasConsented;
    }

    public function hasConsented(): bool
    {
        return $this->userHasConsented;
    }

    public function hasRefused(): bool
    {
        return ! $this->userHasConsented;
    }
}
