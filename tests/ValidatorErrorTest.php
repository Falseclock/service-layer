<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\Validation\ValidatorError;
use PHPUnit\Framework\TestCase;

class ValidatorErrorTest extends TestCase
{
    public const MESSAGE = "test message";
    public const VALUE = 12345;

    public function testConstruction()
    {
        $error = new ValidatorError(self::MESSAGE, self::VALUE);
        self::assertSame(self::MESSAGE, $error->getMessage());
        self::assertSame(self::VALUE, $error->getValue());
    }

    public function testJsonSerialize()
    {
        $error = new ValidatorError(self::MESSAGE, self::VALUE);
        $expect = [
            ValidatorError::FIELD_MESSAGE => $error->getMessage(),
            ValidatorError::FIELD_VALUE => $error->getValue(),
        ];
        self::assertSame($expect, $error->jsonSerialize());
    }
}