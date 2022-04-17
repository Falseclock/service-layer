<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

interface ValidationProcess
{
    /**
     * @param                    $valueOrEnclosure
     * @param Validator ...$validators
     *
     * @return ValidationProcess
     */
    public function add($valueOrEnclosure, Validator ...$validators): ValidationProcess;

    /**
     * @return mixed
     */
    public function validate();
}
