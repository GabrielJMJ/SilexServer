<?php
namespace Gabrieljmj\SilexServer;

class Server
{
    private $host;

    private $port;

    private $callback;

    public function __construct($host, $port, callable $callback = null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->callback = $callback;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function run()
    {
        if (version_compare(PHP_VERSION, '5.4') >= 0) {
            if (null !== $this->callback) {
                $callback = $this->callback;
                $callback();
            }
            
            exec('php -S ' . $this->host . ':' . $this->port);
            return true;
        }

        throw new \RuntimeException('You must update your PHP for version equal or greater v5.4');
    }
}