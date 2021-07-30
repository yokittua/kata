<?php

namespace Kata;

require('vendor/autoload.php');

// create integer
$int1 = new Number\Integer(100);
print_kata($int1);
echo sprintf("\t%s\t%s\n", "toNative()", $int1->toNative());

echo "\n";

// create integer(fromNative method, value=200)
$int2 = Number\Integer::fromNative(200);
print_kata($int2);

echo "\n";

// create integer(fromNative method, value=100)
$int3 = Number\Integer::fromNative(100);
print_kata($int3);

echo "\n";

// compare two objects
echo '$int1->isEqual($int2)     ' . (boolval($int1->isEqual($int2)) ? 'true' : 'false') . "\n";
echo '$int1->isEqual($int3)     ' . (boolval($int1->isEqual($int3)) ? 'true' : 'false') . "\n";

// create location object
$loc = Geo\Location::fromNative(35.0, 135.0, 0.0);
print_kata($loc);
echo "\ttoNative()\n";
print_r($loc->toNative());
echo "\n";


// create J.2000 object
$obj = new DateTime\J2K();
print_kata($obj);
echo "\n";

// create J.2000 object(fromNative method)
$obj2 = DateTime\J2K::fromNative('2020-02-01T12:00:00+09:00');
print_kata($obj2);
echo sprintf("\t%s\t%s\n", "getYearly()", $obj2->getYearly());
echo sprintf("\t%s\t%s\n", "getMonthly()", $obj2->getMonthly());
echo sprintf("\t%s\t%s\n", "getDaily()", $obj2->getDaily());
echo sprintf("\t%s\t%s\n", "getDayTime()", $obj2->getDayTime());
echo sprintf("\t%s\t%s\n", "getTimeZoneOffset()", $obj2->getTimeZoneOffset());
echo "\n";

function print_kata($obj){
    echo sprintf("%s\n", $obj->getName());
    echo sprintf("\t%s\t%s\n", "getName()", $obj->getName());
    echo sprintf("\t%s\t%s\n", "toNatural()", $obj->toNatural());
    echo sprintf("\t%s\t%s\n", "__toString()", $obj->__toString());    
}
