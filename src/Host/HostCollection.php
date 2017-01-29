<?php

namespace LoadBalancer\Host;

/**
 * Collection of hosts class
 *
 * @package Host
 * @author  Tomasz Madeyski <tomasz.madeyski@gmail.com>
 */
class HostCollection
{
    /**
     * @var HostInterface[]
     */
    protected $hosts;

    public function __construct(array $hosts)
    {
        $this->hosts = [];

        foreach ($hosts as $host) {
            if (!($host instanceof HostInterface)) {
                throw new \InvalidArgumentException(sprintf('All hosts must be of type %s', HostInterface::class));
            }

            $this->hosts[] = $host;
        }
    }

    /**
     * @return HostInterface[]
     */
    public function getHosts()
    {
        return $this->hosts;
    }

}
