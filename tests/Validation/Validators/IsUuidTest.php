<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Validation\Validators;

use Falseclock\Service\Validation\Validators\IsUuid;
use PHPUnit\Framework\TestCase;

class IsUuidTest extends TestCase
{
    /** @noinspection PhpRedundantOptionalArgumentInspection */
    public function testCommon()
    {
        $validation = new IsUuid("message");

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

        // Version 1 UUID
        self::assertTrue($validation->check("1bcf1728-be33-11ec-9d64-0242ac120002"));
        // Version 4 UUID
        self::assertTrue($validation->check("d0b6af08-063e-45e4-98ca-76c3e6eceda0"));
        // Version 5
        self::assertTrue($validation->check("630eb68f-e0fa-5ecc-887a-7c7a62614681"));
    }
}
