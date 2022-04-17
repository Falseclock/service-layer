<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Validation\Validators;

use Falseclock\Service\Validation\Validators\IsNumeric;
use PHPUnit\Framework\TestCase;

class IsNumericTest extends TestCase
{
    /**
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = new IsNumeric("message");
        self::assertTrue($validation->check(1));
        self::assertTrue($validation->check(1, true));
        self::assertTrue($validation->check(1.234));
        self::assertTrue($validation->check(1.234, true));
        self::assertTrue($validation->check("1"));
        self::assertTrue($validation->check("2", true));
        self::assertTrue($validation->check("111111111111.1234"));
        self::assertTrue($validation->check("111111111111.1234", true));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check([], true));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check((object)[], true));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));
        self::assertTrue($validation->check(null, true));
    }
}
