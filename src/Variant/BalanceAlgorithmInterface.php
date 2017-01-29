<?php

namespace LoadBalancer\Variant;

use LoadBalancer\Host\HostCollection;
use LoadBalancer\Http\Request\RequestInterface;

interface BalanceAlgorithmInterface
{
    public function loadBalance(RequestInterface $request, HostCollection $hostCollection);
}
