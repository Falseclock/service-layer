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
use Falseclock\Service\Validation\Validators\IsSame;
use PHPUnit\Framework\TestCase;

class IsSameTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function testCommon()
    {
        $validation = (new IsSame("message"))->against(1);
        self::assertTrue($validation->check(1));

        $validation = (new IsSame("message"))->against(1);
        self::assertTrue($validation->check(1));

        $validation = (new IsSame("message"))->against(1.234);
        self::assertTrue($validation->check(1.234));

        $validation = (new IsSame("message"))->against("string");
        self::assertTrue($validation->check("string"));

        $validation = (new IsSame("message"))->against([]);
        self::assertTrue($validation->check([]));

        $validation = (new IsSame("message"))->against(true);
        self::assertTrue($validation->check(true));

        $validation = (new IsSame("message"))->against(false);
        self::assertTrue($validation->check(false));

        $validation = (new IsSame("message"))->against(null);
        self::assertTrue($validation->check(null, true));

        $object = (object)[];
        $validation = (new IsSame("message"))->against($object);
        self::assertTrue($validation->check($object));

        $validation = (new IsSame("message"))->against((object)[]);
        self::assertFalse($validation->check((object)[]));
    }

    /**
     * @throws ValidationException
     */
    public function testException()
    {
        $validation = new IsSame("message");
        $this->expectException(ValidationException::class);
        self::assertTrue($validation->check(1));
    }
}
