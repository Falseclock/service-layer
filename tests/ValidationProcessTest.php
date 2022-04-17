<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\Tests\Example\Requests\ClosureRequest;
use Falseclock\Service\Tests\Example\Requests\ExceptionableRequest;
use Falseclock\Service\Validation\Validators\IsSame;
use PHPUnit\Framework\TestCase;

class ValidationProcessTest extends TestCase
{
    public function testValidateClosure()
    {
        $request = new ClosureRequest();
        $request->validate();

        self::assertTrue(true);
    }

    public function testValidationException()
    {
        $request = new ExceptionableRequest();
        $request->validate();
        self::assertFalse($request->isValid());

        $process = $request->getValidationProcess();
        self::assertNotNull($process);

        $errors = $process->getErrors();

        self::assertCount(1, $errors);
        self::assertSame(IsSame::ERROR_NO_MATCH, $errors[0]->getMessage());
        self::assertNull($errors[0]->getValue());
    }
}
