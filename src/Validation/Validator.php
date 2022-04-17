<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-request
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

/**
 * Interface ValidatorInterface
 *
 * @package MP\Service\Validation
 * @property mixed $value
 */
interface Validator
{
    /**
     * @param mixed $value
     * @param bool|null $nullable
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null, ?bool $nullable = false): bool;

    /**
     * @return ValidatorError
     */
    public function getMessage(): ValidatorError;
}
