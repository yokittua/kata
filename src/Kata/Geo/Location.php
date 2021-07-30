<?php

declare(strict_types=1);

namespace Kata\Geo;

use Kata\KataInterface;

/**
 * class Location
 */
class Location implements KataInterface {
    use \Kata\GetNameTrait;
    use \Kata\IsEqualTrait;

    /**
     * @var latitude
     */
    private $latitude;

    /**
     * @var longitude
     */
    private $longitude;

    /**
     * @var sealevel
     */
    private $sealevel;

    /**
     * @var timezone
     */
    private $timezone;

    /**
     * Returns a new Latitude object
     *
     * @param Latitude $latitude
     * @param Longitude $longitude
     * @param Sealevel $sealevel
     */
    public function __construct(Latitude $latitude, Longitude $longitude, Sealevel $sealevel) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->sealevel = $sealevel;
    }

    /**
     * Returns location latitude
     *
     * @return Latitude
     */
    public function getLatitude(): Latitude {
        return $this->latitude;
    }

    /**
     * Returns location longitude
     *
     * @return Longitude
     */
    public function getLongitude(): Longitude {
        return $this->longitude;
    }

    /**
     * Returns location sealevel
     *
     * @return Sealevel
     */
    public function getSealevel(): Sealevel {
        return $this->sealevel;
    }

    /**
     * Returns a new Location object from native values.
     *
     * @param int|float     $latitude
     * @param int|float     $longitude
     * @param int|float     $sealevel
     *
     * @return KataInterface
     */
    public static function fromNative() : KataInterface {
        $args = func_get_args();

        $lat = $args[0];
        $lon = $args[1];
        $sea = $args[2];
        

        $latitude = Latitude::fromNative($lat);
        $longitude = Longitude::fromNative($lon);
        $sealevel = Sealevel::fromNative($sea);

        return new static($latitude, $longitude, $sealevel);
    }

    /**
     * Returns the native value of an object.
     *
     * @return array
     */
    public function toNative() {
        return array(
            "latitude"      => $this->latitude->toNative(),
            "longitude"     => $this->longitude->toNative(),
            "sealevel"      => $this->sealevel->toNative()
        );
    }

    /**
     * Returns latitude as humanized string
     * 
     * @return string
     */
    public function toNatural() :string {
        $array = array(
            $this->latitude->toNatural(),
            $this->longitude->toNatural(),
            $this->sealevel->toNatural()
        );
        return implode(',', $array);
    }

    public function __toString() {
        return strval($this->toNatural());
    }

}
