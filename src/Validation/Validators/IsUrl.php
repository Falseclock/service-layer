<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

class IsUrl extends IsString
{
    /**
     * @param $value
     * @return bool
     */
    public function check($value = null): bool
    {
        if (!parent::check($value)) {
            return false;
        }

        if (is_null($value) && $this->nullable) {
            return true;
        }

        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;
    }
}
