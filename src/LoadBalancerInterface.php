<?php

namespace LoadBalancer;

use LoadBalancer\Http\Request\RequestInterface;

interface LoadBalancerInterface
{
    public function handleRequest(RequestInterface $request);
}
