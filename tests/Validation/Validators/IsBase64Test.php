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
use Falseclock\Service\Validation\Validators\IsBase64;
use PHPUnit\Framework\TestCase;

class IsBase64Test extends TestCase
{
    /**
     * @throws ValidationException
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $base64 = base64_encode("message");
        $validation = new IsBase64($base64);

        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));
        self::assertTrue($validation->check(base64_encode("message")));

        $validation = new IsBase64($base64, true);
        self::assertTrue($validation->check(null));
        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));

    }
}
