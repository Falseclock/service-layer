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
use Falseclock\Service\Validation\Validators\IsNotSame;
use PHPUnit\Framework\TestCase;

class IsNotSameTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function testCommon()
    {
        $validation = (new IsNotSame("message"))->against(1);
        self::assertFalse($validation->check(1));

        $validation = (new IsNotSame("message"))->against(1);
        self::assertFalse($validation->check(1));

        $validation = (new IsNotSame("message"))->against(1.234);
        self::assertFalse($validation->check(1.234));

        $validation = (new IsNotSame("message"))->against("string");
        self::assertFalse($validation->check("string"));

        $validation = (new IsNotSame("message"))->against([]);
        self::assertFalse($validation->check([]));

        $validation = (new IsNotSame("message"))->against(true);
        self::assertFalse($validation->check(true));

        $validation = (new IsNotSame("message"))->against(false);
        self::assertFalse($validation->check(false));

        $validation = (new IsNotSame("message", true))->against(null);
        self::assertFalse($validation->check());

        $object = (object)[];
        $validation = (new IsNotSame("message"))->against($object);
        self::assertFalse($validation->check($object));

        $validation = (new IsNotSame("message"))->against((object)[]);
        self::assertTrue($validation->check((object)[]));
    }
}
