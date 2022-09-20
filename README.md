<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Install Composer
```bash
Composer Install
```

## Add .env
```bash
cp .env.example .env
```

## Configuration paypal in .env
```bash
#PayPal API Mode
# Values: sandbox or live (Default: live)
PAYPAL_MODE=

#PayPal Setting & API Credentials - sandbox
PAYPAL_SANDBOX_CLIENT_ID=
PAYPAL_SANDBOX_CLIENT_SECRET=

#PayPal Setting & API Credentials - live
PAYPAL_LIVE_CLIENT_ID=
PAYPAL_LIVE_CLIENT_SECRET=
```

## Configuration Xendit APIKey in .env (Optional)
```bash
XENDIT_KEY_API=
```

## Paypal Package

- https://github.com/srmklive/laravel-paypal
- https://github.com/thephpleague/omnipay

## Xendit References

- https://github.com/xendit/checkout-demo-laravel

## LaravelPaypal documentation by srmklive
- https://srmklive.github.io/laravel-paypal/docs.html
