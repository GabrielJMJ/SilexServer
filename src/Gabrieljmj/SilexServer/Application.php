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

use Silex\Application as BaseApplication;
use Gabrieljmj\SilexServer\Server;
use Symfony\Component\HttpFoundation\Request;

class Application extends BaseApplication
{
    /**
     * Creates a server instance
     *
     * @param string        $host
     * @param integer       $port
     * @param callable|null $callback
     *
     * @return \Gabrieljmj\SilexServer\Server
     */
    public function createServer($host, $port, callable $callback = null)
    {
        return new Server($host, $port, $callback);
    }

    /**
     * Handles the request and delivers the response.
     *
     * @param Request|null $request Request to process
     */
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