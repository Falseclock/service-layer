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
use Falseclock\Service\Validation\Validators\IsBetween;
use PHPUnit\Framework\TestCase;

class IsBetweenTest extends TestCase
{
    /**
     * @throws ValidationException
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = (new IsBetween("message"))->min(-10)->max(-1);

        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1, true));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check(1.234, true));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check("string", true));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check([], true));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check((object)[], true));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));
        self::assertTrue($validation->check(null, true));

        self::assertTrue($validation->check(-9));
        self::assertTrue($validation->check(-9.5));

        $validation = (new IsBetween("message"))->min(1.01)->max(1.03);
        self::assertTrue($validation->check(1.02));

    }

    /**
     * @throws ValidationException
     */
    public function testNoMin()
    {
        $validation = (new IsBetween("message"))->max(1.03);
        $this->expectExceptionMessage(IsBetween::ERROR_NO_MIN_DEFINED);
        $validation->check(1);
    }

    /**
     * @throws ValidationException
     */
    public function testNoMax()
    {
        $validation = (new IsBetween("message"))->min(1.03);
        $this->expectExceptionMessage(IsBetween::ERROR_NO_MAX_DEFINED);
        $validation->check(1);
    }

    /**
     * @throws ValidationException
     */
    public function testMinExceptionString()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min("string");
    }

    /**
     * @throws ValidationException
     * @noinspection PhpParamsInspection
     */
    public function testMinExceptionArray()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min([]);
    }

    /**
     * @noinspection PhpParamsInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function testMinExceptionObject()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min((object)[]);
    }

    /**
     * @throws ValidationException
     */
    public function testMinExceptionBooleanTrue()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min(true);
    }

    /**
     * @throws ValidationException
     */
    public function testMinExceptionBooleanFalse()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min(false);
    }

    /**
     * @throws ValidationException
     */
    public function testMaxExceptionString()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min(1)->max("string");
    }

    /**
     * @throws ValidationException
     * @noinspection PhpParamsInspection
     */
    public function testMaxExceptionArray()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min(1)->max([]);
    }

    /**
     * @noinspection PhpParamsInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function testMaxExceptionObject()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min(1)->max((object)[]);
    }

    /**
     * @throws ValidationException
     */
    public function testMaxExceptionBooleanTrue()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min(1)->max(true);
    }

    /**
     * @throws ValidationException
     */
    public function testMaxExceptionBooleanFalse()
    {
        $this->expectExceptionMessage(IsBetween::ERROR_NOT_INTEGER_OR_FLOAT);
        (new IsBetween("message"))->min(1)->max(false);
    }
}
