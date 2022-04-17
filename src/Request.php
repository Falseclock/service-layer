<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service;

use Falseclock\Service\Validation\ValidatorError;

interface Request
{
    /**
     * @return ValidatorError[]
     * @see RequestImpl::validate()
     */
    public function validate(): array;

    /**
     * Every Request class have to declare validation process
     * @return void
     */
    public function initiateValidation(): void;

    /**
     * @return bool
     * @see RequestImpl::isValid()
     */
    public function isValid(): bool;
}
