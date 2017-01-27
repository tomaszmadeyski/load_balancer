<?php

namespace Host;

use LoadBalancer\Http\Request\RequestInterface;

/**
 * Interface for host configuration class
 *
 * @package Host
 * @author  Tomasz Madeyski <tomasz.madeyski@gmail.com>
 */
interface HostInterface
{
    /**
     * Returns current load of host in percents (0-100)
     *
     * @return int
     */
    public function getLoad();

    /**
     * Method handles a request
     *
     * @param RequestInterface $request
     *
     * @return void
     */
    public function handleRequest(RequestInterface $request);
}
