<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Validation\Validators;

use Falseclock\Service\Validation\Validators\IsInteger;
use Falseclock\Service\Validation\Validators\IsNotNull;
use PHPUnit\Framework\TestCase;

class IsNotNullTest extends TestCase
{
    /**
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = new IsNotNull("message");
        self::assertTrue($validation->check(1));
        self::assertTrue($validation->check(1, true));
        self::assertTrue($validation->check(1.234));
        self::assertTrue($validation->check(1.234, true));
        self::assertTrue($validation->check("string"));
        self::assertTrue($validation->check("string", true));
        self::assertTrue($validation->check([]));
        self::assertTrue($validation->check([], true));
        self::assertTrue($validation->check((object)[]));
        self::assertTrue($validation->check((object)[], true));
        self::assertTrue($validation->check(true));
        self::assertTrue($validation->check(false));
        self::assertFalse($validation->check(null));
        self::assertFalse($validation->check(null, true));
    }
}
