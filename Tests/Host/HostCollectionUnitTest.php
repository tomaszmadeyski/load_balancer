<?php

namespace LoadBalancer\Tests\Host;

use LoadBalancer\Host\HostCollection;

class HostCollectionUnitTest extends \PHPUnit_Framework_TestCase
{
    public function test_collection_initialized_with_valid_hosts_should_return_valid_array()
    {
        $arr = [$this->getMockBuilder('LoadBalancer\Host\HostInterface')->getMock(), $this->getMockBuilder('LoadBalancer\Host\HostInterface')->getMock()];
        $hostCollection = new HostCollection($arr);

        $this->assertSame($arr, $hostCollection->getHosts());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_collection_initialized_with_invalid_values_throws_exception()
    {
        $hostCollection = new HostCollection([1,3]);
    }
}
