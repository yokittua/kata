<?php

declare(strict_types=1);

namespace Kata;

/**
 * trait IsEqualTrait
 */
trait IsEqualTrait {
    /**
     * Compare two KataInterface and tells whether they can be considered equal.
     *
     * @param KataInterface $object
     *
     * @return bool
     */
    public function isEqual(KataInterface $intf): bool {
        return ($this->getName() == $intf->getName() && $this->toNatural() == $intf->toNatural());
    }
}