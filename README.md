Load Balancer
=============

[![Build Status](https://travis-ci.org/tomaszmadeyski/load_balancer.svg?branch=master)](https://travis-ci.org/tomaszmadeyski/load_balancer)

Abstract LoadBalancer implementation with two variants:
1. RoundRobin - it distributes load between all hosts just one by one
2. LowLoad - it forwards request to first host with load lower than 75%. 
In case all hosts have load higher than 75% it forwards request to host with lowest load
