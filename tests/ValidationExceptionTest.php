<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\Validation\ValidationException;
use PHPUnit\Framework\TestCase;
use Throwable;

class ValidationExceptionTest extends TestCase
{
    public function testThrow()
    {
        try {
            $exception = new ValidationException('test');
            self::assertSame('test', $exception->getMessage());

            throw new $exception;
        } catch (ValidationException $t) {
            self::assertInstanceOf(Throwable::class, $t);
        }
    }
}
