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
use Falseclock\Service\Validation\Validators\IsInArray;
use PHPUnit\Framework\TestCase;

class IsInArrayTest extends TestCase
{
    /**
     * @throws ValidationException
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testCommon()
    {
        $validation = new IsInArray("message");
        $validation->haystack([1, 2, 3]);

        self::assertFalse($validation->check(4));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));
        self::assertTrue($validation->check(1));
        self::assertTrue($validation->check(2));
        self::assertTrue($validation->check(3));
        self::assertFalse($validation->check(1.0));
        self::assertFalse($validation->check(2.0));
        self::assertFalse($validation->check(3.0));
        self::assertFalse($validation->check("1"));
        self::assertFalse($validation->check("2"));
        self::assertFalse($validation->check("3"));

        $validation = new IsInArray("message", true);
        $validation->haystack([1, 2, 3]);
        self::assertFalse($validation->check(4));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertTrue($validation->check(null));
    }

    /**
     * @throws ValidationException
     */
    public function testHaystack()
    {
        $validation = new IsInArray("message");
        $validation->haystack([1, 2, 3]);

        self::expectExceptionMessage(IsInArray::ERROR_MULTI_DIMENSIONAL);
        $validation->haystack([1, 2, 3, [4, 5, 6]]);
    }

    /**
     * @throws ValidationException
     */
    public function testNoHaystack()
    {
        $validation = new IsInArray("message");
        self::expectExceptionMessage(IsInArray::ERROR_NO_ARRAY_DEFINED);
        $validation->check(1);
    }
}
