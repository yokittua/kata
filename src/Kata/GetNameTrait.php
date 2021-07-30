<?php

declare(strict_types=1);

namespace Kata;

/**
 * trait GetNameTrait
 */
trait GetNameTrait {
    /**
     * Returns the name of the class of an object
     *
     * @return string
     */
    public function getName() : string {
        $return = get_class();
        $return = strtoupper($return);
        return $return;
    }
}