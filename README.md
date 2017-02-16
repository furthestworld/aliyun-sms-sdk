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

// Create launcher instanse.
$launcher = new AliYunSmsSdk\Launcher("Your access key ID", "Your access secret");

// Create model instanse.
$mould = $launcher->mould("Sign Name", "Template Code");

// Send message.
$response = $mould->send(
    "18888888888",         // Mobile number, An array can be sent to multiple numbers.
    ["code" => 100000]     // Template variables.
);

$response->body();      // JSON
$response->result();    // Array
$response->code();      // Integer
$response->success();   // Boolean
$response->requestId(); // String

?>
```

# License #

Apache License 2.0