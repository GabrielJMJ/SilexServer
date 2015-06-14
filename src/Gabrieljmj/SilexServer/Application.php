<?php
namespace Gabrieljmj\SilexServer;

use Silex\Application as BaseApplication;
use Gabrieljmj\SilexServer;
use Symfony\Component\HttpFoundation\Request;

class Application extends BaseApplication
{
    public function createServer($host, $port, callable $callback = null)
    {
        return new Server($host, $port, $callback);
    }

    public function run(Request $request = null)
    {
        if (php_sapi_name() !== 'cli') {
            if (null === $request) {
                $request = Request::createFromGlobals();
            }
            $response = $this->handle($request);
            $response->send();
            $this->terminate($request, $response);
        }
    }
}