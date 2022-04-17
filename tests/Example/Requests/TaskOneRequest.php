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
use Falseclock\Service\Validation\Validators\IsBoolean;
use Falseclock\Service\Validation\Validators\IsInteger;
use Falseclock\Service\Validation\Validators\IsString;

class TaskOneRequest extends RequestImpl
{
    /** @var string */
    public $var1;
    /** @var bool */
    public $var2;
    /** @var int */
    public $var3;

    public function initiateValidation(): void
    {
        $this->addValidator($this->var1, new IsString("Var1 is not string"));
        $this->addValidator($this->var2, new IsBoolean("Var2 is not boolean"));
        $this->addValidator($this->var3, new IsInteger("Var3 is not integer"));
    }
}
