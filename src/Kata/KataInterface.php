<?php
declare(strict_types=1);

namespace Kata;

/**
 * Interface KataInterface
 */
interface KataInterface {
    /**
     * Compare two KataInterface and tells whether they can be considered equal.
     *
     * @param KataInterface $object
     *
     * @return bool
     */
    public function isEqual(KataInterface $intf): bool;

    /**
     * Returns a object taking PHP native values as argumenta.
     *
     * @return KataInterface
     */
    public static function fromNative(): KataInterface;

    /**
     * Returns the value of an object.
     *
     * @return mixed
     */
    public function toNative();

    /**
     * Returns the name of the class of an object
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Returns a humanized string representation of an object
     *
     * @return string
     */
    public function toNatural() :string;

    /**
     * Returns a string representation of the class when treated as a string .
     * 
     * @return string
     */
    public function __toString() :string;
}
