SilexServer
===========
Easily create  web servers for your Silex web application.

## Installation
Via [Composer](https://getcomposer.org):
```console
composer require gabrieljmj/silex-server
```

## Usage
Create your Silex application normaly:
```php
# index.php
<?php

require_once 'vendor/autoload.php';

$app = new Gabrieljmj\SilexServer\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
  return 'Hello '.$app->escape($name);
});

$app->run();

return $app; // This MUST be in the file
```

And now create the bin that will create the server:
```php
#!/usr/bin/env php
<?php
$app = require_once 'index.php';

$host = 'localhost';
$port = 3000;

$app->createServer($host, $port, function () use ($port) {
    echo "Running on port {$port}\n";
})->run();
```

Build the server:
```console
your-bin
```
Now you can access ```http://localhost:3000```.