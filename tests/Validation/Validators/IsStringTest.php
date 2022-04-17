<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Validation\Validators;

use Falseclock\Service\Validation\Validators\IsString;
use PHPUnit\Framework\TestCase;

class IsStringTest extends TestCase
{
    /**
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = new IsString("message");
        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1, true));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check(1.234, true));
        self::assertTrue($validation->check("string"));
        self::assertTrue($validation->check("string", true));
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
