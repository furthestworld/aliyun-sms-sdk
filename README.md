# About #

Aliyun short message service software development kit.

[![Build Status](https://travis-ci.org/edoger/aliyun-sms-sdk.svg?branch=master)](https://travis-ci.org/edoger/aliyun-sms-sdk)
[![Latest Stable Version](https://poser.pugx.org/edoger/aliyun-sms-sdk/v/stable)](https://packagist.org/packages/edoger/aliyun-sms-sdk)
[![Latest Unstable Version](https://poser.pugx.org/edoger/aliyun-sms-sdk/v/unstable)](https://packagist.org/packages/edoger/aliyun-sms-sdk)
[![Total Downloads](https://poser.pugx.org/edoger/aliyun-sms-sdk/downloads)](https://packagist.org/packages/edoger/aliyun-sms-sdk)
[![License](https://poser.pugx.org/edoger/aliyun-sms-sdk/license)](https://packagist.org/packages/edoger/aliyun-sms-sdk)

# Example #
```php
<?php

$sms = new Services\Sms("your-access-key-id", "your-access-secret");

$response = $sms->send(
    "Your-Sign-Name", 
    "Your-Template-Code", 
    "18888888888",               // Mobile number, An array can be sent to multiple numbers.
    ["code" => 100000]           // Template variables.
);

$response->body();               // The response JSON.
$response->result();             // The response array.
$response->status();             // The response HTTP status code.
$response->success();            // Is OK ?
$response->exists("RequestId");  // Determines whether a result data exists.
$response->get("RequestId");     // Get a result data by name.

?>
```

# License #

Apache License 2.0