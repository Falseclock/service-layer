<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\RequestException;
use Falseclock\Service\Tests\Example\Requests\ExceptionRequest;
use PHPUnit\Framework\TestCase;

class RequestExceptionTest extends TestCase
{
    public function testConstruct()
    {
        $this->expectException(RequestException::class);
        $request = new ExceptionRequest();
        self::assertNull($request);
    }
}
