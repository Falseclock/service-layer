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

class IsFloat extends ValidatorImpl
{
    public const ERROR_INT_PROVIDED = "IsInteger class should not validate integer values";

    /**
     * @param mixed $value
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null): bool
    {
        if (is_null($value) && $this->nullable) {
            return true;
        }

        if (is_int($value)) {
            throw new ValidationException(self::ERROR_INT_PROVIDED);
        }

        return is_float($value);
    }
}
