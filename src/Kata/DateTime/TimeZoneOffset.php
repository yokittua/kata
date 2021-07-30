<?php

declare(strict_types=1);

namespace Kata\DateTime;

use Kata\Number\Integer;

/**
 * class TimeZoneOffset
 * 
 */
class TimeZoneOffset extends Integer {

    /**
     * Returns a TimeZoneOffset object taking PHP native int as arguments.
     *
     * @param int $hours
     * 
     * @return static
     */
    public static function fromHours($hours): TimeZoneOffset {
        $seconds = $hours * 3600;
        return new staitc($seconds);
    }

    /**
     * Returns a TimeZoneOffset object taking PHP native DateTimeInterface as arguments.
     *
     * @param DateTimeInterface $date
     * 
     * @return static
     */
    public static function fromDateTime(\DateTimeInterface $date): TimeZoneOffset {
        $I = $date->getOffset();
        $return = TimeZoneOffset::fromNative($I);
        return $return;
    }
    
    /**
     * Returns the timezone offset from GMT in hours via HH:MM format.
     * 
     * @return float
     */
    public function toNatural() :string {
        $hours = intdiv($this->asInteger(), 3600);
        $secs = intdiv($this->asInteger() % 3600, 60);
        return sprintf("%+03d:%02d", $hours, $secs);
    }

    /**
     * Returns the timezone offset from GMT in hours via PHP native float value.
     * 
     * @return float
     */
    public function asI():float {
        return $this->toNative() / 3600;
    }
}
