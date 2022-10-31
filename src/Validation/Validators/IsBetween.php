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

class IsBetween extends ValidatorImpl
{
    public const ERROR_NO_MAX_DEFINED = "No maximum defined";
    public const ERROR_NO_MIN_DEFINED = "No minimum defined";
    public const ERROR_NOT_INTEGER_OR_FLOAT = "Provided value is not integer or float type";
    /** @var int|float */
    protected $maximum;
    /** @var int|float */
    protected $minimum;

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

        if (!isset($this->minimum)) {
            throw new ValidationException(self::ERROR_NO_MIN_DEFINED);
        }

        if (!isset($this->maximum)) {
            throw new ValidationException(self::ERROR_NO_MAX_DEFINED);
        }

        if (!is_int($value) && !is_float($value)) {
            return false;
        }

        return $value >= $this->minimum and $value <= $this->maximum;
    }

    /**
     * @param int|float $maximum
     * @return $this
     * @throws ValidationException
     */
    public function max($maximum): IsBetween
    {
        if (!is_float($maximum) && !is_int($maximum)) {
            throw new ValidationException(self::ERROR_NOT_INTEGER_OR_FLOAT);
        }

        $this->maximum = $maximum;

        return $this;
    }

    /**
     * @param int|float $minimum
     * @return $this
     * @throws ValidationException
     */
    public function min($minimum): IsBetween
    {
        if (!is_float($minimum) && !is_int($minimum)) {
            throw new ValidationException(self::ERROR_NOT_INTEGER_OR_FLOAT);
        }

        $this->minimum = $minimum;

        return $this;
    }
}
