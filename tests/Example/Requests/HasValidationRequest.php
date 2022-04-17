<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Example\Requests;

use Falseclock\Service\RequestImpl;
use Falseclock\Service\Validation\Validators\IsString;

class HasValidationRequest extends RequestImpl
{
    /** @var string */
    public $var;

    public function initiateValidation(): void
    {
        $this->addValidator($this->var, new IsString("Var1 is not string"));
    }
}
