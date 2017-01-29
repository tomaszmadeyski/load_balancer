<?php

namespace LoadBalancer\Variant;

use LoadBalancer\Host\HostCollection;

class RoundRobin extends BaseLoadBalanceVariant implements BalanceAlgorithmInterface
{
    protected $nextIndexToUse = 0;

    /**
     * @return int
     */
    public function getNextIndexToUse()
    {
        return $this->nextIndexToUse;
    }

    /**
     * {@inheritdoc}
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
