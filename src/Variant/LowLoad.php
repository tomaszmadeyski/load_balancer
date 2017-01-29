<?php

namespace LoadBalancer\Variant;

use LoadBalancer\Host\HostCollection;

/**
 * LowLoad balancing variant. It forwards request to first host with load lower than LOW_LOAD_TRESHOLD
 * or if all hosts have load higher than LOW_LOAD_TRESHOLD to host with lowest load
 *
 * @package LoadBalancer\Variant
 * @author  Tomasz Madeyski <tomasz.madeyski@gmail.com>
 */
class LowLoad extends BaseLoadBalanceVariant implements BalanceAlgorithmInterface
{

    const LOW_LOAD_TRESHOLD = 75;

    /**
     * {@inheritdoc}
     */
    protected function getNextHostToUse(HostCollection $hostCollection)
    {
        $hosts = $hostCollection->getHosts();
        $lowestLoad = 101; //initializing with high value so it bigger than highest possible load
        $lowestLoadIndex = 0;

        foreach ($hosts as $key => $host) {
            $currentHostLoad = $host->getLoad();
            if ($currentHostLoad < self::LOW_LOAD_TRESHOLD) {
                return $host;
            }

            if ($currentHostLoad < $lowestLoad) {
                $lowestLoad = $currentHostLoad;
                $lowestLoadIndex = $key;
            }
        }

        return $hosts[$lowestLoadIndex];
    }
}
