<?php

namespace LoadBalancer\Variant;


use LoadBalancer\Host\HostCollection;
use LoadBalancer\Host\HostInterface;
use LoadBalancer\Http\Request\RequestInterface;

abstract class BaseLoadBalanceVariant implements BalanceAlgorithmInterface
{
    public function loadBalance(RequestInterface $request, HostCollection $hostCollection)
    {
        $hostToUse = $this->getNextHostToUse($hostCollection);

        $hostToUse->handleRequest($request);
    }

    /**
     * @param HostCollection $hostCollection
     *
     * @return HostInterface
     */
    abstract protected function getNextHostToUse(HostCollection $hostCollection);
}
