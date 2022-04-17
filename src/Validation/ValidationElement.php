<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-request
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

use Closure;

final class ValidationElement
{
    /** @var Validator $validator */
    public $validator;
    /** @var scalar|callable|Closure $valueOrEnclosure */
    public $valueOrEnclosure;

    /**
     * ValidationElement constructor.
     *
     * @param scalar|callable|Closure $valueOrEnclosure
     * @param Validator $validator
     */
    public function __construct($valueOrEnclosure, Validator $validator)
    {
        $this->valueOrEnclosure = $valueOrEnclosure;
        $this->validator = $validator;
    }
}
