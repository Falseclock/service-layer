<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\ServiceException;
use Falseclock\Service\Tests\Example\ServiceExample;
use PHPUnit\Framework\TestCase;

class ServiceExceptionTest extends TestCase
{
    /**
     * @throws ServiceException
     */
    public function testException()
    {
        $service = new ServiceExample();
        $this->expectException(ServiceException::class);
        $response = $service->doTaskFour();
        self::assertNull($response);
    }
}