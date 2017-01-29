<?php

namespace LoadBalancer\Tests\Variant;


use LoadBalancer\Host\HostCollection;
use LoadBalancer\Http\Request\RequestInterface;
use LoadBalancer\Variant\RoundRobin;

class RoundRobinUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideHosts
     *
     * @param HostCollection $hostCollection
     */
    public function test_load_balance_should_use_valid_host(HostCollection $hostCollection)
    {
        /** @var RequestInterface $request */
        $request = $this->getMockBuilder('LoadBalancer\Http\Request\RequestInterface')->getMock();
        $roundRobin = new RoundRobin();

        $hosts = $hostCollection->getHosts();
        for ($i = 0; $i < count($hosts); $i++) {
            $this->assertEquals($i, $roundRobin->getNextIndexToUse());
            $hosts[$i]->expects($this->once())
                ->method('handleRequest');

            $roundRobin->loadBalance($request, $hostCollection);
        }

    }

    public function provideHosts()
    {
        $hostMock = $this->getMockBuilder('LoadBalancer\Host\HostInterface')->getMock();

        return [
            [new HostCollection([clone $hostMock])],
            [new HostCollection([clone $hostMock, clone $hostMock])],
            [new HostCollection([clone $hostMock, clone $hostMock, clone $hostMock, clone $hostMock])],
        ];
    }
}
