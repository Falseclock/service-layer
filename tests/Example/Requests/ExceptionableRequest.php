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
use Falseclock\Service\Validation\Validators\IsSame;

class ExceptionableRequest extends RequestImpl
{
    public const ERROR = "Value is not the same";
    /** @var int */
    public $var;

    public function initiateValidation(): void
    {
        $this->addValidator($this->var, new IsSame(self::ERROR));
    }
}
