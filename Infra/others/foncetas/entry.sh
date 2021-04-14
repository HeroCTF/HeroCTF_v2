#!/bin/bash

while :
do
	su -c "exec socat TCP-LISTEN:7002,reuseaddr,fork EXEC:'/pwn/chall,stderr'" - pwnuser;
done
