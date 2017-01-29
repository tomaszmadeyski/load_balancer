<?php

namespace LoadBalancer;

use LoadBalancer\Host\HostCollection;
use LoadBalancer\Http\Request\RequestInterface;
use LoadBalancer\Variant\BalanceAlgorithmInterface;

/**
 * Load balancer implementation
 *
 * @package LoadBalancer
 * @author  Tomasz Madeyski <tomasz.madeyski@gmail.com>
 */
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

        if (empty($this->hostCollection->getHosts())) {
            throw new \InvalidArgumentException('HostCollection must not be empty');
        }
    }

    /**
     * Handles request using algorithm set in constructor
     *
     * @param RequestInterface $request
     */
    public function handleRequest(RequestInterface $request)
    {
        $this->balanceAlgorithm->loadBalance($request, $this->hostCollection);
    }
}
