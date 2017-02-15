# About #

Aliyun short message service software development kit.

# Example #
```php
<?php

// Create launcher instanse.
$launcher = new AliYunSmsSdk\Launcher([
    "accessKeyId"  => "Your Access Key Id",
    "accessSecret" => "Your Access Secret",
]);

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