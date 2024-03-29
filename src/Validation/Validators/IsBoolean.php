<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

use Falseclock\Service\Validation\ValidatorImpl;

class IsBoolean extends ValidatorImpl
{
    /**
     * @param null $value
     * @return bool
     */
    public function check($value = null): bool
    {
        if (is_null($value) && $this->nullable) {
            return true;
        }
        return is_bool($value);
    }
}
