<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Validation\Validators;

use Falseclock\Service\Validation\ValidationException;
use Falseclock\Service\Validation\Validators\IsInteger;
use PHPUnit\Framework\TestCase;

class IsIntegerTest extends TestCase
{
    /**
     * @throws ValidationException
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = new IsInteger("message");
        self::assertTrue($validation->check(1));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));

        self::expectExceptionMessage(IsInteger::ERROR_FLOAT_PROVIDED);
        self::assertFalse($validation->check(1.234));

        $validation = new IsInteger("message", true);
        self::assertTrue($validation->check(1));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertTrue($validation->check(null));
    }
}
