<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Example\Requests;

use Closure;
use Falseclock\Service\RequestImpl;
use Falseclock\Service\Validation\Validators\IsInstanceOf;
use stdClass;

class ClosureRequest extends RequestImpl
{
    public $closure;

    public function __construct(?stdClass $stdClass = null)
    {
        parent::__construct($stdClass);

        $this->closure = function () {
            return 'I am a closure';
        };
    }

    public function initiateValidation(): void
    {
        $this->addValidator($this->closure, (new IsInstanceOf("wrong class"))->class(Closure::class));
    }
}
