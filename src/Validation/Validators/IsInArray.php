<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

use Falseclock\Service\Validation\ValidationException;
use Falseclock\Service\Validation\ValidatorImpl;

class IsInArray extends ValidatorImpl
{
    public const ERROR_MULTI_DIMENSIONAL = "Array must not be multi dimensional";
    public const ERROR_NO_ARRAY_DEFINED = "No haystack array defined";
    /** @var array */
    protected $haystack;

    /**
     * @param null $value
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null): bool
    {
        if (is_null($value) && $this->nullable) {
            return true;
        }

        if (!is_array($this->haystack))
            throw new ValidationException(self::ERROR_NO_ARRAY_DEFINED);

        return in_array($value, $this->haystack, true);
    }

    /**
     * @param array $array
     *
     * @return $this
     * @throws ValidationException
     */
    public function haystack(array $array): IsInArray
    {
        // Check for multi dimensional array
        if (count($array) != count($array, COUNT_RECURSIVE)) {
            throw new ValidationException(self::ERROR_MULTI_DIMENSIONAL);
        }

        $this->haystack = $array;

        return $this;
    }
}
