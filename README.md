# Make your Laravel app comply with the refuse/accept cookie law

[![Latest Version on Packagist](https://img.shields.io/packagist/v/retinens/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/retinens/laravel-cookie-consent)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/retinens/laravel-cookie-consent/run-tests?label=tests)
[![Total Downloads](https://img.shields.io/packagist/dt/retinens/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/retinens/laravel-cookie-consent)


All sites owned by EU citizens or targeted towards EU citizens must comply with a crazy EU law. This law requires a dialog to be displayed to inform the users of your websites how cookies are being used. You can read more info on the legislation on [the site of the European Commission](http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm#section_2).

The users should be presented the option to agree or disagree with the optional cookies.

This package is based on the spatie/laravel-cookie-consent package by the good folks at Spatie.

This package provides an easily configurable view to display the message. Also included is JavaScript code to set a cookie when a user agrees or disagrees with the cookie policy. The user can also disagree, and the cookie is set the 0. The package will not display the dialog when that cookie has been set.

## Installation

You can install the package via composer:

``` bash
composer require retinens/laravel-cookie-consent
```

The package will automatically register itself.

Optionally you can publish the config-file:

```bash
php artisan vendor:publish --provider="Retinens\CookieConsent\CookieConsentServiceProvider" --tag="cookie-consent-config"
```

This is the contents of the published config-file:

```php
return [

    /*
     * Use this setting to enable the cookie consent dialog.
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),
    
    /*
     * Use this setting to add a refuse button on the dialog.
    */
    'refuse_enabled' => env('COOKIE_CONSENT_REFUSE_ENABLED', false),

    /*
     * The name of the cookie in which we store if the user
     * has agreed to accept the conditions.
     */
    'cookie_name' => 'laravel_cookie_consent',

    /*
     * Set the cookie duration in days.  Default is 365 * 1.
     */
    'cookie_lifetime' => 365 * 1,
];
```

## Usage

To display the dialog all you have to do is include this view in your template:

```blade
//in your blade template
@include('cookie-consent::index')
```

This will render the following dialog that, when styled, will look very much like this one.

![dialog](https://retinens.github.io/laravel-cookie-consent/images/dialog.png)

The default styling provided by this package uses TailwindCSS v2 to provide a floating banner at the bottom of the page.

When the user clicks "Allow cookies" a `laravel_cookie_consent` cookie will be set and the dialog will be removed from the DOM. On the next request, Laravel will notice that the `laravel_cookie_consent` has been set and will not display the dialog again

## Refuse button

If you want to add a refuse button to the dialog, you can enable the option in the config file. When the user clicks on "Refuse non-essential cookies" a `laravel_cookie_consent` cookie will be set with the value of `0`.

## Customising the dialog texts

If you want to modify the text shown in the dialog you can publish the lang-files with this command:

```bash
php artisan vendor:publish --provider="Retinens\CookieConsent\CookieConsentServiceProvider" --tag="cookie-consent-translations"
```

This will publish this file to `resources/lang/vendor/cookie-consent/en/texts.php`.

 ```php
 
 return [
     'message' => 'Please be informed that this site uses cookies.',
     'agree' => 'Allow cookies',
     'refuse' => 'Refuse non-essential cookies',
 ];
 ```
 
 If you want to translate the values to, for example, French, just copy that file over to `resources/lang/vendor/cookie-consent/fr/texts.php` and fill in the French translations.
 
### Customising the dialog contents

If you need full control over the contents of the dialog. You can publish the views of the package:

```bash
php artisan vendor:publish --provider="Retinens\CookieConsent\CookieConsentServiceProvider" --tag="cookie-consent-views"
```

This will copy the `index` and `dialogContents` view files over to `resources/views/vendor/cookie-consent`. You probably only want to modify the `dialogContents` view. If you need to modify the JavaScript code of this package you can do so in the `index` view file.

## Using the middleware

Instead of including `cookie-consent::index` in your view you could opt to add the `Retinens\CookieConsent\CookieConsentMiddleware` to your kernel:

```php
// app/Http/Kernel.php

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
        \Retinens\CookieConsent\CookieConsentMiddleware::class,
    ];

    // ...
}
```

This will automatically add `cookie-consent::index` to the content of your response right before the closing body tag.

## Helper

In your code you can use the facade to get the info if the user has accepted or not the non-essential cookies.
```php
CookieConsent::hasConsented();
CookieConsent::hasRefused();
```

That way you can (or not) add cookies for the user, or add scripts into the header.

## Notice
The legislation is pretty very vague on how to display the warning, which texts are necessary, and what options you need to provide. This package will go a long way towards compliance, but if you want to be 100% sure that your website is ok, you should consult a legal expert.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email lucas@retinens.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
