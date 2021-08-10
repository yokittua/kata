# Kata

Kata (Japanese for 'type', written as '型') is the PHP minimal classes of value object for astronomical calculations.

This repository is a partial fork from shouze/valueobjects that aims to provide the minimum required classes for our astronomical calculations. It also contains units for J.2000 and geography tasks.

## Setup

```
% git clone https://github.com/yokittua/kata
% composer install
% composer dump-autoload
```

## Usage

The following is a source code which is a example of this library.

``` php
<?php

namespace Kata;

require('vendor/autoload.php');

$int = new Number\Integer(100);

var_dump($int)
object(Kata\Number\Integer)#3 (1) {
  ["integer":"Kata\Number\Integer":private]=>
  int(100)
}

$loc = Geo\Location::fromNative(35.0, 135.0, 0.0);

// var_dump($loc)
object(Kata\Geo\Location)#7 (4) {
  ["latitude":"Kata\Geo\Location":private]=>
  object(Kata\Geo\Latitude)#4 (1) {
    ["float":"Kata\Number\Real":private]=>
    float(35)
  }
  ["longitude":"Kata\Geo\Location":private]=>
  object(Kata\Geo\Longitude)#5 (1) {
    ["float":"Kata\Number\Real":private]=>
    float(135)
  }
  ["sealevel":"Kata\Geo\Location":private]=>
  object(Kata\Geo\Sealevel)#6 (1) {
    ["float":"Kata\Number\Real":private]=>
    float(0)
  }
  ["timezone":"Kata\Geo\Location":private]=>
  NULL
}

$j2k = DateTime\J2K::fromNative('2020-02-01T12:00:00+09:00');

// var_dump($j2k)
object(Kata\DateTime\J2K)#2 (3) {
  ["date"]=>
  string(26) "2020-02-01 12:00:00.000000"
  ["timezone_type"]=>
  int(1)
  ["timezone"]=>
  string(6) "+09:00"
}
```

## Used by

* [https://koyocalc.jp](https://koyocalc.jp) - Website dedicated to calculating sunrise time in Japan.

## References

* Nicolò Pignatelli, "ValueObjects", [https://github.com/shouze/valueobjects](https://github.com/shouze/valueobjects).
* National Astronomical Observatory Japan, "Chronological Scientific Tables", Maruzen, 2014.
* NASA, "Polynomial Expressions for Delta T", [https://eclipse.gsfc.nasa.gov/SEcat5/deltatpoly.html](https://eclipse.gsfc.nasa.gov/SEcat5/deltatpoly.html).
* K. Nagasawa, "Computations of Sunrise and Sunset", Chijin-Shokann, 1999.

## License

Kata is released under the GPLv3 License. See the bundled `LICENSE` file for details.
