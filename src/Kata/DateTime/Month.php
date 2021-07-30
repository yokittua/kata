<?php

declare(strict_types=1);

namespace Kata\DateTime;

use Kata\Number\Integer;
use Kata\Exception\InvalidNativeArgumentException;

/**
 * class Month
 */
class Month extends Integer {
    /**
     * Minimum value indicating the month.
     */
    const MIN_MONTH = 1;

    /**
     * Maximum value indicating the month.
     */
    const MAX_MONTH = 12;

    /**
     * Returns a new month day.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN_MONTH, 'max_range' => self::MAX_MONTH)
        );

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, array('int (>=1, <=12)'));
        }

        parent::__construct($filteredValue);
    }

}
