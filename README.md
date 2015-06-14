SilexServer
===========
[![Build Status](https://travis-ci.org/GabrielJMJ/SilexServer.svg?branch=master)](https://travis-ci.org/GabrielJMJ/SilexServer) [![License](https://img.shields.io/packagist/l/gabrieljmj/silex-server.svg)](https://packagist.org/packages/gabrieljmj/silex-server) [![Latest Unstable Version](https://img.shields.io/badge/unstable-dev--dev-orange.svg)](https://packagist.org/packages/gabrieljmj/silex-server) [![Total Downloads](https://img.shields.io/packagist/dt/gabrieljmj/silex-server.svg)](https://packagist.org/packages/gabrieljmj/silex-server) [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/gabrieljmj/silexserver.svg)](https://scrutinizer-ci.com/g/GabrielJMJ/SilexServer/?branch=dev)

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