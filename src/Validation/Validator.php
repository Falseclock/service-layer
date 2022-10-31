<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

interface Validator
{
    /**
     * @param mixed $value
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null): bool;

    /**
     * @return ValidatorError
     */
    public function getMessage(): ValidatorError;
}
