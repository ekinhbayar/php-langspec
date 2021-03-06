--TEST--
PHP Spec test generated from ./classes/__php_incomplete_class.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

class Point
{
	private $x;
	private $y;

	public function __construct($x = 0, $y = 0)
	{
		$this->x = $x;
		$this->y = $y;

		echo "\nInside " . __METHOD__ . ", $this\n\n";
	}

	public function __toString()
	{
		return '(' . $this->x . ',' . $this->y . ')';
	}	
}

echo "---------------- create, serialize, and unserialize a Point -------------------\n";

$p = new Point(2, 5);
echo "Point \$p = $p\n";

$s = serialize($p);		// all instance properties get serialized
var_dump($s);

echo "------\n";

$v = unserialize($s);	// without a __wakeup method, any instance property present
						// in the string takes on its default value.
var_dump($v);

$s[5] = 'J';		// change class name, so a unserialize failure occurs
var_dump($s);
$v = unserialize($s);
var_dump($v);
print_r($v);
--EXPECT--
---------------- create, serialize, and unserialize a Point -------------------

Inside Point::__construct, (2,5)

Point $p = (2,5)
string(54) "O:5:"Point":2:{s:8:" Point x";i:2;s:8:" Point y";i:5;}"
------
object(Point)#2 (2) {
  ["x":"Point":private]=>
  int(2)
  ["y":"Point":private]=>
  int(5)
}
string(54) "O:5:"Joint":2:{s:8:" Point x";i:2;s:8:" Point y";i:5;}"
object(__PHP_Incomplete_Class)#3 (3) {
  ["__PHP_Incomplete_Class_Name"]=>
  string(5) "Joint"
  ["x":"Point":private]=>
  int(2)
  ["y":"Point":private]=>
  int(5)
}
__PHP_Incomplete_Class Object
(
    [__PHP_Incomplete_Class_Name] => Joint
    [x:Point:private] => 2
    [y:Point:private] => 5
)
