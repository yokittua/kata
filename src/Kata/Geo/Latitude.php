<?php
declare(strict_types=1);

namespace Kata\Geo;

use League\Geotools\Coordinate\Coordinate as BaseCoordinate;
use Kata\Number\Real;

/**
 * class Latitude
 */
class Latitude extends Real {
    /**
     * Returns a new Latitude object
     *
     * @param $value
     */
    public function __construct($value) {
        $coordinate = new BaseCoordinate(array($value, 0));
        $latitude   = $coordinate->getLatitude();

        parent::__construct($latitude);
    }

    /**
     * Returns latitude as humanized string
     * 
     * @return string
     */
    public function toNatural() :string {
        $prefix = ($this->toNative() >= 0) ? 'N' : 'S';
        $abs = abs($this->toNative());
        $abs = $this->toFormat($abs);
        return $prefix . $abs;
    }
}
