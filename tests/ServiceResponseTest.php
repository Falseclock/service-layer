<?php
declare(strict_types=1);

namespace Falseclock\Service\Tests;

use Falseclock\Service\ServiceError;
use Falseclock\Service\ServiceResponse;
use Falseclock\Service\Validation\ValidatorError;
use PHPUnit\Framework\TestCase;

class ServiceResponseTest extends TestCase
{
    public function testHasServerErrors() {
        $response = new ServiceResponse(null);
        self::assertFalse($response->hasServerErrors());

        $response = new ServiceResponse(null, [new ServiceError("error")]);
        self::assertTrue($response->hasServerErrors());
        self::assertTrue($response->isFailed());
        self::assertFalse($response->isSuccess());
    }

    public function testHasNotServerErrors() {
        $response = new ServiceResponse(null);
        self::assertTrue($response->hasNotServerErrors());

        $response = new ServiceResponse(null, [new ServiceError("error")]);
        self::assertFalse($response->hasNotServerErrors());
        self::assertTrue($response->isFailed());
        self::assertFalse($response->isSuccess());
    }

    public function testIsSuccess() {
        $response = new ServiceResponse(null);
        self::assertTrue($response->isSuccess());

        $response = new ServiceResponse(null, [], [new ValidatorError("invalid")]);
        self::assertFalse($response->hasServerErrors());
        self::assertTrue($response->isFailed());
        self::assertFalse($response->isSuccess());
    }

    public function testIsFailed() {
        $response = new ServiceResponse(null);
        self::assertFalse($response->isFailed());

        $response = new ServiceResponse(null, [], [new ValidatorError("invalid")]);
        self::assertFalse($response->hasServerErrors());
        self::assertTrue($response->isFailed());
        self::assertFalse($response->isSuccess());
    }
}
