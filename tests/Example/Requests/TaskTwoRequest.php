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

class TaskTwoRequest extends RequestImpl
{
    /** @var string */
    public $string;

    public function initiateValidation(): void
    {
        $this->addValidator($this->string, new IsString("TaskTwoRequest::string is not string"));
    }
}
