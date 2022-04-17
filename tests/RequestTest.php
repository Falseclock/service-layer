<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\Tests\Example\Requests\HasValidationRequest;
use Falseclock\Service\Tests\Example\Requests\NoValidationRequest;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testIsValid()
    {
        $request = new NoValidationRequest();

        self::assertTrue($request->isValid());
        self::assertNull($request->var1);
        self::assertCount(0, $request->getErrors());

        $request = new HasValidationRequest();
        self::assertFalse($request->isValid());
        self::assertNull($request->var);
        self::assertCount(1, $request->getErrors());

        self::assertTrue(true);
    }

    public function testConstruct()
    {
        $request = new HasValidationRequest((object)array('var' => '123', 'noVar' => '456'));
        self::assertNotNull($request->var);
        self::assertNotEmpty($request->var);
        self::assertIsString($request->var);
        self::assertSame('123', $request->var);
        self::assertFalse(property_exists($request, 'noVar'));
    }

    public function testToString()
    {
        $request = new HasValidationRequest();
        $request->var = '6-7-8';
        self::assertNotNull($request->var);

        $expect = json_encode(['var' => '6-7-8'], JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

        $actual = (string)$request;

        self::assertNotNull($actual);
        self::assertNotEmpty($actual);

        self::assertSame($expect, $actual);
    }
}