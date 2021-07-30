<?php

declare(strict_types=1);

namespace Kata\DateTime;

use Kata\Number\Real;

/**
 * class DayTime
 * 
 * for example:
 * 00:00            -> 0.000
 * 06:00            -> 0.250
 * 12:00            -> 0.500
 * 21:00            -> 0.875
 * 00:00(next day)  -> 1.000
 */
class DayTime extends Real {
    /**
     * Returns a new object with time added to that object 
     * 
     * @param float $value
     * 
     * @return DayTime
     */
    public function Annex($value): DayTime {
        $d = $this->asFloat() + $value;
        return new static($d);
    }
    /**
     * Returns a DayTime object taking PHP native DateTimeInterface as argumenta.
     *
     * @return KataInterface
     */
    public static function fromDateTime(\DateTimeInterface $date) : DayTime {
        $return = $date->format('H') * 60 * 60 + $date->format('i') * 60 + $date->format('s');
        $return /= 86400;
        $return = DayTime::fromNative($return);
        return $return;
    }
}
