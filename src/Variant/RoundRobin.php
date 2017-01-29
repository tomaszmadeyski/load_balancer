<?php

namespace LoadBalancer\Variant;

use LoadBalancer\Host\HostCollection;
use LoadBalancer\Http\Request\RequestInterface;

class RoundRobin implements BalanceAlgorithmInterface
{
    protected $nextIndexToUse = 0;

    public function loadBalance(RequestInterface $request, HostCollection $hostCollection)
    {
        $hostToUse = $this->getNextHostToUse($hostCollection);

        $hostToUse->handleRequest($request);
    }

    /**
     * @return int
     */
    public function getNextIndexToUse()
    {
        return $this->nextIndexToUse;
    }

    /**
     * @param HostCollection $hostCollection
     *
     * @return \LoadBalancer\Host\HostInterface
     */
    protected function getNextHostToUse(HostCollection $hostCollection)
    {
        $hosts = $hostCollection->getHosts();

        if ($this->nextIndexToUse >= count($hosts)) {
            $this->nextIndexToUse = 0;
        }

        return $hosts[$this->nextIndexToUse++];
    }
}
