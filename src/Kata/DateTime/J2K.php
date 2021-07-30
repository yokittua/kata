<?php

declare(strict_types=1);

namespace Kata\DateTime;

use DateTimeImmutable;
use Kata\KataInterface;
use Kata\DateTime\J2KY;
use Kata\DateTime\J2KD;
use Kata\DateTime\DayTime;
use Kata\DateTime\Year;
use Kata\DateTime\Month;
use Kata\DateTime\Day;
use Kata\DateTime\TimeZoneOffset;

/**
 * class J2K
 * 
 * January 1, 2000 Number of years elapsed since dynamical time.
 * 2000年1月1日力学時正午からの経過時間（年数・日数）
 */
class J2K extends DateTimeImmutable implements KataInterface {
    use \Kata\GetNameTrait;
    use \Kata\IsEqualTrait;

    /**
     * Returns a new J2K object
     *
     * $datetime is a date/time string. Valid formats are explained in Date and Time Formats.
     * 
     * @param $datetime
     */
    public function __construct(string $datetime = "now"){
        parent::__construct($datetime);
    }

    /**
     * Returns a object taking PHP native values as argumenta.
     *
     * $datetime is a date/time string. Valid formats are explained in Date and Time Formats.
     * 
     * @param $datetime

     * @return KataInterface
     */
    public static function fromNative() : KataInterface {
        $value = func_get_arg(0);
        return new static($value);
    }

    /**
     * Returns the native value of an object as DateTimeImmutable via RFC 3339 extended format(ex: 2005-08-15T15:52:01.000+00:00).
     * 
     * @return DateTimeImmutable
     */
    public function toNative() {
        $obj = new \DateTimeImmutable($this->format('c'));
        return $obj;
    }

    /**
     * Returns the humanized string of an object via RFC 2882 format(ex: hu, 21 Dec 2000 16:01:07 +0200).
     * 
     * @return string
     */
    public function toNatural() :string {
        return $this->format('r');
    }

    /**
     * Returns a string representation of the class when treated as a string .
     * 
     * @return string
     */
    public function __toString() {
        return $this->toNatural();
    }

    /**
     * Returns a new J2K object from native values.
     *
     * @param int    $year
     * @param int    $month
     * @param int    $day
     * @param DayTime   $d
     * @param TimeZoneOffset    $I
     *
     * @return J2K
     */
    public static function create(Year $year, Month $month, Day $day, DayTime $d, TimeZoneOffset $I) {
        $ymd = sprintf("%d-%02d-%02d", $year->asInteger(), $month->asInteger(), $day->asInteger());
        $offset = $I->toNatural();
        $obj = new \DateTime(sprintf("%sT00:00:00%s", $ymd, $offset));
        $seconds = floor($d->asFloat() * 86400);
        $obj = $obj->modify("$seconds seconds");
        $text = $obj->format("c");
        return new J2K($text);
    }

    /**
     * Returns a new J2K object from native values.
     *
     * @param int    $year
     * @param int    $month
     * @param int    $day
     * @param DayTime   $d
     * @param TimeZoneOffset    $I
     *
     * @return J2K
     */
    public static function createFrom(\DateTimeInterface $datetime): J2K {
        return new J2K($datetime->format('c'));
    }

    /**
     * Return J.2000 progress days
     *
     * @return J2KD
     */
    public function getProgressDay(): J2KD{
        $y = $this->getYearly();
        $m = $this->getMonthly();
        $d = $this->getDaily();
        $I = $this->getTimeZoneOffset();
        $return = 365 * $y + 30 * $m + $d - 33.5 + floor( 3 * ($m + 1) / 5 ) + floor($y /4) - $I->asI() / 24;
        return J2KD::fromNative($return);
    }

    /**
     * Return J.2000 progress years
     *
     * @return J2KY
     */
    public function getProgressYear() : J2KY {
        $return = $this->getProgressDay()->asFloat();
        $return += $this->getDayTime()->asFloat();
        $delta_t = J2K::delta_UT($this->format('Y'), $this->format('n'));
        $delta_t /= 86400;
        $return += $delta_t;
        $return /= 365.25;
        return J2KY::fromNative($return);
    }

    /**
     * Returns J.2000's year
     *
     * @return int
     */
    public function getYearly() {
        $y = $this->format('Y') - 2000;
        if ($this->format('n') <= 2 ) {
            $y--;
        }
        return intval($y);
    }
    /**
     * Returns J.2000's month
     *
     * @return int
     */
    public function getMonthly() {
        $m = $this->format('n');
        if ($m <= 2 ) {
            $m += 12;
        }
        return $m;
    }
    
    /**
     * Returns J.2000's day
     *
     * @return int
     */
    public function getDaily() {
        return $this->format('j');
    }

    /**
     * Returns J2K time
     *
     * @return DayTime
     */
    public function getDayTime() :DayTime {
        $d = $this->format('H') * 3600;
        $d += $this->format('i') * 60;
        $d += $this->format('s');
        $d /= 86400;
        $return = DayTime::fromNative($d);
        return $return;
    }

    /**
     * Returns J2K timezone offset
     *
     * @return TimeZoneOffset
     */
    public function getTimeZoneOffset() : TimeZoneOffset {
        $return = TimeZoneOffset::fromNative($this->getOffset());
        return $return;
    }

    /**
     * Returns J2K's delta UT
     *
     * source:
     * https://eclipse.gsfc.nasa.gov/SEcat5/deltatpoly.html
     * 
     * @return float
     */
    public static function delta_UT($year, $month): float{
        $y = $year + ($month - 0.5 ) / 12;
        if ($year < 2005) {
            return 64;
        }
        else if ($year < 2050) {
            $t = $y - 2000;
            $delta_t = 62.92 + 0.32217 * $t + 0.005589 * $t * $t;
            return $delta_t;
        } else if ($year < 2150 ) {
            $delta_t = -20 + 32 * pow(($y-1820) / 100, 2) - 0.5628 * (2150 - $y);
            return $delta_t;
        } else {
            $u = ($y -1820) / 100;
            $delta_t = -20 + 32 * $u * $u;
            return $delta_t;
        }
    }
}
