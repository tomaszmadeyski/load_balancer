<?php

namespace LoadBalancer\Tests\Variant;


use LoadBalancer\Host\HostCollection;
use LoadBalancer\Host\HostInterface;
use LoadBalancer\Http\Request\RequestInterface;
use LoadBalancer\Variant\LowLoad;

class LowLoadUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param HostCollection $hostCollection
     * @param int            $indexOfHostToUse;
     *
     * @dataProvider provideHosts
     */
    public function test_load_balance_should_use_valid_host(HostCollection $hostCollection, $indexOfHostToUse)
    {
        /** @var RequestInterface $request */
        $request = $this->getMockBuilder('LoadBalancer\Http\Request\RequestInterface')->getMock();
        $roundRobin = new LowLoad();

        $hosts = $hostCollection->getHosts();

        /** @var HostInterface|\PHPUnit_Framework_MockObject_MockObject $host */
        foreach ($hosts as $key => $host) {
            if ($key == $indexOfHostToUse) {
                $host->expects($this->once())
                    ->method('handleRequest');
            } else {
                $host->expects($this->never())
                    ->method('handleRequest');
            }
        }

        $roundRobin->loadBalance($request, $hostCollection);
    }

    public function provideHosts()
    {
        $hostMockLowest = $this->getHostMockWithLoad(LowLoad::LOW_LOAD_TRESHOLD - 30);
        $hostMockLower = $this->getHostMockWithLoad(LowLoad::LOW_LOAD_TRESHOLD - 10);
        $hostMockEqual = $this->getHostMockWithLoad(LowLoad::LOW_LOAD_TRESHOLD);
        $hostMockHigher = $this->getHostMockWithLoad(LowLoad::LOW_LOAD_TRESHOLD + 10);
        $hostMockHighest = $this->getHostMockWithLoad(LowLoad::LOW_LOAD_TRESHOLD + 20);


        return [
            //just one
            [new HostCollection([clone $hostMockLower]), 0],
            //first with load lower than treshold
            [new HostCollection([clone $hostMockLower, clone $hostMockLowest]), 0],
            //last one is with lowest load, all are with load higher than treshold
            [new HostCollection([clone $hostMockHighest, clone $hostMockHighest, clone $hostMockHigher]), 2],
            //first one with lowest load
            [new HostCollection([clone $hostMockEqual, clone $hostMockHighest, clone $hostMockHigher]), 0],
            //second with lowest load
            [new HostCollection([clone $hostMockHigher, clone $hostMockEqual, clone $hostMockHigher]), 1],
            //second one is a first wil load lower than treshold
            [new HostCollection([clone $hostMockEqual, clone $hostMockLower, clone $hostMockLowest]), 1],
        ];
    }

    /**
     * @param int $load
     *
     * @return HostInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getHostMockWithLoad($load){
        $mock = $this->getMockBuilder('LoadBalancer\Host\HostInterface')->getMock();
        $mock->expects($this->any())
            ->method('getLoad')
            ->will($this->returnValue($load));

        return $mock;
    }

}
