--TEST--
Compress below factor and fail to plain.
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
$m = new Memcached();
$m->addServer('localhost', 11211, 1);

ini_set('memcached.compression_threshold', 100);
ini_set('memcached.compression_factor', 10);
$array = range(1, 20000, 1);

$m->set('foo', $array, 10);
$rv = $m->get('foo');
var_dump($array === $rv);


--EXPECT--
bool(true)
