<?php

namespace Retinens\CookieConsent\Test;

use Illuminate\Support\Facades\Cookie;
use Retinens\CookieConsent\Facades\CookieConsent;

class CookieConsentFacadeTest extends TestCase
{
    /** @test */
    public function hasConsented_function_will_return_true_if_user_has_accepted()
    {
        request()->cookies->set(config('cookie-consent.cookie_name'), cookie(config('cookie-consent.cookie_name'), 1));
        $this->assertTrue(CookieConsent::hasConsented());
    }

    /** @test */
    public function hasConsented_function_will_return_false_if_user_has_refused()
    {
        request()->cookies->set(config('cookie-consent.cookie_name'), cookie(config('cookie-consent.cookie_name'), 0));
        $this->assertFalse(CookieConsent::hasConsented());
    }

    /** @test */
    public function hasRefused_function_will_return_false_if_user_has_accepted()
    {
        request()->cookies->set(config('cookie-consent.cookie_name'), cookie(config('cookie-consent.cookie_name'), 1));
        $this->assertFalse(CookieConsent::hasRefused());
    }

    /** @test */
    public function hasRefused_function_will_return_true_if_user_has_refused()
    {
        request()->cookies->set(config('cookie-consent.cookie_name'), cookie(config('cookie-consent.cookie_name'), 0));
        $this->assertTrue(CookieConsent::hasRefused());
    }


}
