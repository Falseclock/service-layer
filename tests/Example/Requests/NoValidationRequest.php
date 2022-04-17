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

class NoValidationRequest extends RequestImpl
{
    /** @var string */
    public $var1;

    public function initiateValidation(): void
    {
    }
}
