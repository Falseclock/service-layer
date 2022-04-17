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

class IsInteger extends ValidatorImpl
{
    public const ERROR_FLOAT_PROVIDED = "IsInteger class should not validate float values";

    /**
     * @param $value
     * @param bool|null $nullable
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null, ?bool $nullable = false): bool
    {
        if (is_null($value) && $nullable) {
            return true;
        }

        if (is_float($value)) {
            throw new ValidationException(self::ERROR_FLOAT_PROVIDED);
        }

        return is_integer($value);
    }
}
