<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Example;

use Falseclock\Service\Request;
use Falseclock\Service\Service;
use Falseclock\Service\ServiceError;
use Falseclock\Service\ServiceException;
use Falseclock\Service\ServiceResponse;
use Psr\Log\LoggerInterface;

class ServiceExample extends Service
{
    public const ERROR_CODE_EXAMPLE = 2345;

    protected ?LoggerInterface $logger = null;

    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return ServiceResponse
     */
    public function doValidationTask(Request $request): ServiceResponse
    {
        if (!$this->validateRequest($request))
            return $this->invalidRequestResponse();

        return $this->createResponse(true);
    }

    /**
     * @param Request $request
     * @return ServiceResponse
     */
    public function doTaskTwo(Request $request): ServiceResponse
    {
        if (!$this->validateRequest($request))
            return $this->invalidRequestResponse();

        $this->addError(new ServiceError("task 2 failed", self::ERROR_CODE_EXAMPLE));

        return $this->createResponse(null);
    }

    /**
     * @return ServiceResponse
     */
    public function doTaskThree(): ServiceResponse
    {
        return $this->invalidRequestResponse();
    }

    /**
     * @throws ServiceException
     */
    public function doTaskFour(): ServiceResponse
    {
        if (5 > 3) {
            throw new ServiceException("test exception");
        }
        return $this->invalidRequestResponse();
    }
}
