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

class IsPositiveFloat extends IsFloat
{
    /**
     * @param null $value
     * @param bool|null $nullable
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null, ?bool $nullable = false): bool
    {
        if (!parent::check($value, $nullable)) {
            return false;
        }

        return $value > 0.0;
    }
}
