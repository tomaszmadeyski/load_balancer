<?php

namespace LoadBalancer;

use Host\HostCollection;
use LoadBalancer\Http\Request\RequestInterface;
use Variant\BalanceAlgorithmInterface;

class LoadBalancer implements LoadBalancerInterface
{
    /**
     * @var HostCollection
     */
    protected $hostCollection;
    /**
     * @var BalanceAlgorithmInterface
     */
    protected $balanceAlgorithm;

    public function __construct(HostCollection $hostCollection, BalanceAlgorithmInterface $balanceAlgorithm)
    {
        $this->hostCollection = $hostCollection;
        $this->balanceAlgorithm = $balanceAlgorithm;
    }
    
    public function handleRequest(RequestInterface $request)
    {
        // TODO: Implement handleRequest() method.
    }
}
