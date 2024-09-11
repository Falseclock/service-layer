<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2024 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

use Falseclock\Service\Validation\ValidatorImpl;

class IsNull extends ValidatorImpl
{
    /**
     * @param null $value
     * @return bool
     */
    public function check($value = null): bool
    {
        return is_null($value);
    }
}
