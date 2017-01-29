<?php

namespace LoadBalancer\Host;


use LoadBalancer\Http\Request\RequestInterface;

class Host implements HostInterface
{

    /**
     * Returns current load of host in percents (0-100)
     *
     * @return int
     */
    public function getLoad()
    {
        // TODO: Implement getLoad() method.
    }

    /**
     * Method handles a request
     *
     * @param RequestInterface $request
     *
     * @return void
     */
    public function handleRequest(RequestInterface $request)
    {
        // TODO: Implement handleRequest() method.
    }
}
