<?php

declare(strict_types=1);

namespace Kata\Number;

use Kata\KataInterface;
use Kata\Exception\InvalidNativeArgumentException;

/**
 * class Real
 */
class Real implements KataInterface {
    use \Kata\GetNameTrait;
    use \Kata\IsEqualTrait;

    /**
     * @var float
     */
    private $float;

    /**
     * Returns a Real object given a PHP native numeric as parameter.
     *
     * @param string|int|float $value
     */
    public function __construct($value) {
        $value = \filter_var($value, FILTER_VALIDATE_FLOAT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, ['float or int']);
        }
        $this->float = $value;
    }

    /**
     * Returns a object taking PHP native values as argumenta.
     *
     * @return KataInterface
     */
    public static function fromNative() : KataInterface {
        $value = func_get_arg(0);
        return new static($value);
    }

    /**
     * Returns the native value of an object.
     *
     * @return mixed
     */
    public function toNative() {
        return $this->float;
    }

    /**
     * Returns real as humanized string.
     *
     * @return string
     */
    public function toNatural() :string {
        return $this->toFormat($this->toNative());
    }

    /**
     * Returns formatted value.
     *
     * @return string
     */
    public function toFormat($value) :string {
        $precision = $this->getPrecision();
        $format = "%0.${precision}f";
        return sprintf($format, $value);
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
     * Returns the number of decimal places to indicate precision
     * 
     * @return int
     */
    public function getPrecision(): int {
        return 6;
    }

    /**
     * Returns a float representation of the class when treated as a float.
     * 
     * @return float
     */
    public function asFloat(): float {
        return $this->toNative();
    }
}
