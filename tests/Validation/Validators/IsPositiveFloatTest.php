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
use Falseclock\Service\Validation\Validators\IsFloat;
use Falseclock\Service\Validation\Validators\IsPositiveFloat;
use PHPUnit\Framework\TestCase;

class IsPositiveFloatTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function testCommon()
    {
        $validation = new IsPositiveFloat("message");
        self::assertTrue($validation->check(1.234));
        self::assertTrue($validation->check(0.00000000000001));
        self::assertFalse($validation->check(0.0));
        self::assertFalse($validation->check(-1.234));
        self::assertFalse($validation->check(-0.00000000000001));
        self::assertFalse($validation->check(""));

        self::expectExceptionMessage(IsFloat::ERROR_INT_PROVIDED);
        self::assertFalse($validation->check(1));
    }
}
