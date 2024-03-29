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

class IsIpAddress extends ValidatorImpl
{
    public function check($value = null): bool
    {
        if (is_null($value) && $this->nullable) {
            return true;
        }

        if (!is_string($value)) {
            return false;
        }

        return inet_pton($value) !== false;
    }
}
