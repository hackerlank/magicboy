#! /bin/sh
alive=`ps -ef | grep memcached | grep -v "grep" | wc -l`;

if [ $alive != 1 ]
then
	memcached -d -c 2048 -m512 -uroot
else
	echo alive
fi
