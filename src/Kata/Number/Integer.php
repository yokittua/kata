<?php
declare(strict_types=1);

namespace Kata\Number;

use Kata\KataInterface;

/**
 * class Integer
 */
class Integer implements KataInterface {
    use \Kata\GetNameTrait;
    use \Kata\IsEqualTrait;
    use Kata\Exception\InvalidNativeArgumentException;

    /**
     * @var integaer
     */
    private $integer;

    /**
     * Returns a Integer object given a PHP native numeric as parameter.
     *
     * @param string|int $value
     */
    public function __construct($value) {
        if (is_numeric($value) == false) {
            throw new InvalidNativeArgumentException($value, ['float or int']);
        }
        $this->integer = intval($value);
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
        return $this->integer;
    }

    /**
     * Returns integer as humanized string.
     *
     * @return string
     */
    public function toNatural() :string {
        return strval($this->toNative());
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
     * Returns a int representation of the class when treated as a integer.
     * 
     * @return int
     */
    public function asInteger(): int {
        return $this->toNative();
    }
}
