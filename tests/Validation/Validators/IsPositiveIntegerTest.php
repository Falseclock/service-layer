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
use Falseclock\Service\Validation\Validators\IsPositiveInteger;
use PHPUnit\Framework\TestCase;

class IsPositiveIntegerTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function testCommon()
    {
        $validation = new IsPositiveInteger("message");
        self::assertTrue($validation->check(1));
        self::assertFalse($validation->check(-1));
        self::assertFalse($validation->check(0));
        self::assertFalse($validation->check(""));

        $this->expectErrorMessage(IsInteger::ERROR_FLOAT_PROVIDED);
        self::assertFalse($validation->check(1.00000001));
    }
}
