<?php
/**
 * Gabrieljmj\SilexServer
 *
 * @author Gabriel Jacinto aka. GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT
 * @version v1.0
 *
 * Copyright (c) 2015 Gabriel Jacinto
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:<br /><br/>
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.<br /><br />
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Gabrieljmj\SilexServer;

class Server
{
    /**
     * The server host
     *
     * @var string
     */
    private $host;

    /**
     * The server port
     *
     * @var integer
     */
    private $port;

    /**
     * Will be executed when the server is created
     *
     * @var callable
     */
    private $callback;

    /**
     * @param string        $host
     * @param integer       $port
     * @param callable|null $callback
     */
    public function __construct($host, $port, callable $callback = null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->callback = $callback;
    }

    /**
     * Returns the server host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Returns the server port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Builds the server using the -S options of PHP
     *
     * @return boolean
     *
     * @throws \RuntimeException if the PHP version is smaller than 5.4
     */
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