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
use Falseclock\Service\Validation\Validators\IsIntegerNotEquals;
use PHPUnit\Framework\TestCase;

class IsIntegerNotEqualsTest extends TestCase
{
    /**
     * @throws ValidationException
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = (new IsIntegerNotEquals("message"))->against(2);
        self::assertTrue($validation->check(1));
        self::assertTrue($validation->check(1, true));

        self::assertTrue($validation->check("string"));
        self::assertTrue($validation->check("string", true));
        self::assertTrue($validation->check([]));
        self::assertTrue($validation->check([], true));
        self::assertTrue($validation->check((object)[]));
        self::assertTrue($validation->check((object)[], true));
        self::assertTrue($validation->check(true));
        self::assertTrue($validation->check(false));
        self::assertTrue($validation->check(null));
        self::assertTrue($validation->check(null, true));
        self::assertFalse($validation->check(2));

        $this->expectErrorMessage(IsInteger::ERROR_FLOAT_PROVIDED);
        self::assertTrue($validation->check(1.234));
    }

    /**
     * @throws ValidationException
     */
    public function testNoClass()
    {
        $validation = new IsIntegerNotEquals("message");
        $this->expectErrorMessage(IsIntegerNotEquals::ERROR_NOTHING_TO_COMPARE);
        self::assertFalse($validation->check(1));
    }
}
