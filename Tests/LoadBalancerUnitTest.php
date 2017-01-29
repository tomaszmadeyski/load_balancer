<?php

namespace LoadBalancer\Tests;

use LoadBalancer\Host\Host;
use LoadBalancer\Host\HostCollection;
use LoadBalancer\Http\Request\RequestInterface;
use LoadBalancer\LoadBalancer;
use LoadBalancer\Variant\BalanceAlgorithmInterface;

class LoadBalancerUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BalanceAlgorithmInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $balanceVariant;
    /**
     * @var RequestInterface
     */
    protected $request;

    public function setUp()
    {
        $this->balanceVariant = $this->getMockBuilder('LoadBalancer\Variant\BalanceAlgorithmInterface')
            ->getMock();
        $this->request = $this->getMockBuilder('LoadBalancer\Http\Request\RequestInterface')
            ->getMock();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_initialized_with_empty_host_collection_throws_exception()
    {
        $hostCollection = new HostCollection([]);

        $loadBalancer = new LoadBalancer($hostCollection, $this->balanceVariant);
    }

    public function test_handle_request_should_call_balance_variant()
    {
        $hostCollection = new HostCollection([new Host()]);;

        $this->balanceVariant->expects($this->once())
            ->method('loadBalance');

        $loadBanalcer = new LoadBalancer($hostCollection, $this->balanceVariant);
        $loadBanalcer->handleRequest($this->request);
    }
}
