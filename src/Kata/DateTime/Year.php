<?php

declare(strict_types=1);

namespace Kata\DateTime;

use Kata\Number\Integer;
use Kata\Exception\InvalidNativeArgumentException;

/**
 * class Year
 */
class Year extends Integer {
    /**
     * Minimum value indicating the year.
     */
    const MIN_YEAR = 1;

    /**
     * Maximum value indicating the year.
     */
    const MAX_YEAR = 9999;

    /**
     * Returns a new year.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN_YEAR, 'max_range' => self::MAX_YEAR)
        );

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, array('int (>=1, <=9999)'));
        }

        parent::__construct($filteredValue);
    }
}
