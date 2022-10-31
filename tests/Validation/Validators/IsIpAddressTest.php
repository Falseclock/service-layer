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
use Falseclock\Service\Validation\Validators\IsIpAddress;
use PHPUnit\Framework\TestCase;

class IsIpAddressTest extends TestCase
{
    /**
     * @throws ValidationException
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = new IsIpAddress("message");

        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        //FIXME:self::assertFalse($validation->check("string"));
        //FIXME:self::assertFalse($validation->check("string", true));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));

        self::assertTrue($validation->check("1.2.3.4"));
        self::assertTrue($validation->check("0.0.0.0"));
        self::assertTrue($validation->check("2001:0db8::0001:0000"));
        self::assertTrue($validation->check("2001:db8:1234:0000:0000:0000:0000:0000"));
        self::assertTrue($validation->check("::ffff:192.0.2.128"));
        //FIXME:self::assertFalse($validation->check("1.2.3.4/24"));
        //FIXME:self::assertFalse($validation->check("0.0.0.0/32"));
        //FIXME:self::assertFalse($validation->check("2001:db8:1234:0000:0000:0000:0000:0000/24"));

        $validation = new IsIpAddress("message", true);
        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertTrue($validation->check(null));
    }
}
