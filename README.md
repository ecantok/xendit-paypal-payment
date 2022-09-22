## Install Composer
```bash
Composer Install && Composer Update
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

## Xendit Package
- https://github.com/xendit/xendit-php

## Xendit References

- https://github.com/xendit/checkout-demo-laravel

## Laravel-paypal documentation by srmklive
- https://srmklive.github.io/laravel-paypal/docs.html

## Xendit Documentation REST API
- https://developers.xendit.co/api-reference/
