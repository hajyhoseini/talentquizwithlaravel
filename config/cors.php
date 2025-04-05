<?php

return [
    'paths' => ['api/*', '*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],  // می‌توانید این را به دامنه خاصی تغییر دهید
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
