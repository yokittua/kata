<?php

declare(strict_types=1);

namespace Kata\Geo;

use Kata\Number\Real;

/**
 * class Sealevel
 */
class Sealevel extends Real {
    /**
     * Returns valid decimal digits 
     * 
     * @return int
     */
    public function getPrecision(): int {
        return 1;
    }
}
