<?php

namespace LoadBalancer\Variant;


use LoadBalancer\Host\HostCollection;
use LoadBalancer\Http\Request\RequestInterface;

class LowLoad implements BalanceAlgorithmInterface
{

    public function loadBalance(RequestInterface $request, HostCollection $hostCollection)
    {
        // TODO: Implement loadBalance() method.
    }
}
