<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\ServiceError;
use Falseclock\Service\Tests\Example\ExampleLogger;
use Falseclock\Service\Tests\Example\Requests\TaskOneRequest;
use Falseclock\Service\Tests\Example\Requests\TaskTwoRequest;
use Falseclock\Service\Tests\Example\ServiceExample;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    /** @var ServiceExample */
    protected $service;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->service = new ServiceExample(new ExampleLogger());
    }

    public function testAddError()
    {
        $request = new TaskTwoRequest();
        $request->string = "string";

        $response = $this->service->doTaskTwo($request);

        self::assertCount(0, $response->getRequestErrors());
        self::assertCount(1, $response->getServiceErrors());
        self::assertNull($response->getResult());

        self::assertTrue($response->hasServerError(ServiceExample::ERROR_CODE_EXAMPLE));
    }

    public function testInvalidRequestResponse()
    {
        $this->service = new ServiceExample(new ExampleLogger());

        $response = $this->service->doTaskThree();

        self::assertCount(0, $response->getRequestErrors());
        self::assertCount(1, $response->getServiceErrors());
        self::assertNull($response->getResult());

        self::assertTrue($response->hasServerError(ServiceError::ERROR_INVALID_REQUEST));
    }

    public function testValidateRequest()
    {
        $response = $this->service->doValidationTask(new TaskOneRequest());

        self::assertTrue($response->isRequestInValid());
        self::assertFalse($response->isRequestValid());
        self::assertNull($response->getResult());
        self::assertCount(3, $response->getRequestErrors());
        self::assertCount(1, $response->getServiceErrors());
        self::assertTrue($response->hasServerError(ServiceError::ERROR_INVALID_REQUEST));
        self::assertFalse($response->hasServerError(ServiceError::ERROR_UNEXPECTED));

        foreach ($response->getServiceErrors() as $error) {
            self::assertNotNull($error->getMessage());
            self::assertNotEmpty($error->getMessage());
        }

        self::assertTrue(true);
    }
}
