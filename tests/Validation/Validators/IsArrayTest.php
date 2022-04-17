<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Validation\Validators;

use Falseclock\Service\Validation\Validators\IsArray;
use PHPUnit\Framework\TestCase;

class IsArrayTest extends TestCase
{
    /**
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = new IsArray("message");
        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1, true));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check(1.234, true));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check("string", true));
        self::assertTrue($validation->check([]));
        self::assertTrue($validation->check([], true));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check((object)[], true));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));
        self::assertTrue($validation->check(null, true));
    }
}
