<?php
declare(strict_types=1);

namespace Kata\Geo;

use League\Geotools\Coordinate\Coordinate as BaseCoordinate;
use Kata\Number\Real;

/**
 * class Longitude
 */
class Longitude extends Real {
    /**
     * Returns a new Longitude object
     *
     * @param $value
     */
    public function __construct($value) {
        $coordinate = new BaseCoordinate(array(0, $value));
        $longitude = $coordinate->getLongitude();

        parent::__construct($longitude);
    }
    /**
     * Returns longitude as humanized string
     * 
     * @return string
     */
    public function toNatural() :string {
        $prefix = ($this->toNative() >= 0) ? 'E' : 'W';
        $abs = abs($this->toNative());
        $abs = $this->toFormat($abs);
        return $prefix . $abs;
    }
}
