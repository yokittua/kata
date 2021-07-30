<?php

declare(strict_types=1);

namespace Kata\DateTime;

use Kata\KataInterface;
use Kata\Number\Real;
use Kata\DateTime\Year;
use Kata\DateTime\Month;
use Kata\DateTime\Day;

/**
 * class Ymd
 */
class Ymd implements KataInterface {
    use \Kata\GetNameTrait;
    use \Kata\IsEqualTrait;
    
    /**
     * @var year
     */
    protected $year;

    /**
     * @var month
     */
    protected $month;

    /**
     * @var day
     */
    protected $day;

    /**
     * Returns a new Ymd object
     *
     * $datetime is a date/time string. Valid formats are explained in Date and Time Formats.
     * 
     * @param $datetime
     */
    public function __construct(Year $year, Month $month, Day $day) {
        \DateTime::createFromFormat('Y-n-j', \sprintf('%d-%d-%d', $year->toNative(), $month->toNative(), $day->toNative()));
        $nativeDateErrors = \DateTime::getLastErrors();

        if ($nativeDateErrors['warning_count'] == 0 || $nativeDateErrors['error_count'] == 0) {
            $this->year = $year;
            $this->month = $month;
            $this->day = $day;
        }
    }

    /**
     * Returns a new Ymd object from native values.
     *
     * @param int    $year
     * @param int    $month
     * @param int    $day
     *
     * @return Ymd
     */
    public static function fromNative() : KataInterface {
        $args = func_get_args();
        return new static( Year::fromNative($args[0]), Month::fromNative($args[1]), Day::fromNative($args[2]) );
    }

    /**
     * Returns the native value of an PHP native DateTime object.
     * 
     * @return DateTime
     */
    public function toNative() {
        $year = $this->year->toNative();
        $month = $this->month->toNative();
        $day = $this->day->toNative();

        $date = new \DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0, 0);

        return $date;
    }

    /**
     * Returns the humanized string of an object as 'YYYY-MM-DD' format.
     * 
     * @return string
     */
    public function toNatural() :string {
        $date = new \DateTime();
        $date->setDate($this->year->toNative(), $this->month->toNative(), $this->day->toNative());
        $date->setTime(0, 0, 0);
        return $date->format('Y-m-d');
    }

    /**
     * Returns a string representation of the class when treated as a string .
     * 
     * @return string
     */
    public function __toString() {
        return strval($this->toNatural());
    }

    /**
     * Returns Ymd year
     *
     * @return Year
     */
    public function getYear() :Year {
        return $this->year;
    }

    /**
     * Returns Ymd month
     *
     * @return Month
     */
    public function getMonth() :Month {
        return $this->month;
    }

    /**
     * Returns Ymd day
     *
     * @return day
     */
    public function getDay() :Day {
        return $this->day;
    }

    /**
     * Returns a Ymd object taking PHP native DateTimeInterface as arguments.
     *
     * @param DateTimeInterface $date
     * 
     * @return Ymd
     */
    public static function fromDateTime(\DateTimeInterface $date): Ymd {
        $y = $date->format('Y');
        $n = $date->format('n');
        $j = $date->format('j');
        return Ymd::fromNative($y, $n, $j);
    }
}
