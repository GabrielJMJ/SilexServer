<?php
namespace Test\Gabrieljmj\SilexServer;

use Gabrieljmj\SilexServer\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatingAServer()
    {
        $app = new Application();
        $host = 'localhost';
        $port = 3000;
        $server = $app->createServer($host, $port);

        $this->assertEquals($host, $server->getHost());
        $this->assertEquals($port, $server->getPort());
    }
}