<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Example\Requests;

use Falseclock\Service\RequestException;
use Falseclock\Service\RequestImpl;
use stdClass;

class ExceptionRequest extends RequestImpl
{
    /**
     * @throws RequestException
     */
    public function __construct(?stdClass $stdClass = null)
    {
        parent::__construct($stdClass);

        throw new RequestException();
    }

    public function initiateValidation(): void
    {
    }
}
