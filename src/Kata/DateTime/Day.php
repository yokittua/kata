<?php

declare(strict_types=1);

namespace Kata\DateTime;

use Kata\Number\Integer;
use Kata\Exception\InvalidNativeArgumentException;

/**
 * class Day
 */
class Day extends Integer {
    /**
     * Minimum value indicating the month day.
     */
    const MIN_DAY = 1;

    /**
     * Maximum value indicating the month day.
     */
    const MAX_DAY = 31;

    /**
     * Returns a new month day.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN_DAY, 'max_range' => self::MAX_DAY)
        );

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, array('int (>=1, <=31)'));
        }

        parent::__construct($filteredValue);
    }
}
