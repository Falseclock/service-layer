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
use Falseclock\Service\Validation\Validators\IsInstanceOf;
use PHPUnit\Framework\TestCase;
use stdClass;

class IsInstanceOfTest extends TestCase
{
    /**
     * @throws ValidationException
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = (new IsInstanceOf("message"))->class(stdClass::class);
        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertTrue($validation->check((object)[]));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));

        $validation = (new IsInstanceOf("message", true))->class(stdClass::class);
        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertTrue($validation->check((object)[]));
        self::assertTrue($validation->check(null));
    }

    /**
     * @throws ValidationException
     */
    public function testNoClass()
    {
        $validation = new IsInstanceOf("message");
        self::expectExceptionMessage(IsInstanceOf::ERROR_NOT_CLASS_DEFINED);
        self::assertFalse($validation->check(1));
    }
}
