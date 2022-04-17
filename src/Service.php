<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service;

use Falseclock\Service\Validation\ValidatorError;
use Psr\Log\LoggerInterface;

abstract class Service
{
    /** @var ValidatorError[] */
    public $lastValidationErrors = [];
    /** @var LoggerInterface */
    protected $logger;
    /** @var ServiceResponse */
    protected $response;
    /** @var ServiceError[] */
    protected $serviceErrors = [];

    /**
     * Service constructor.
     *
     * @param LoggerInterface|null $logger
     */
    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * @return ServiceResponse
     */
    final public function invalidRequestResponse(): ServiceResponse
    {
        $this->serviceErrors[] = new ServiceError("Request parameters are invalid", ServiceError::ERROR_INVALID_REQUEST);

        return new ServiceResponse(null, $this->serviceErrors, $this->lastValidationErrors);
    }

    /**
     * @param ServiceError $error
     * @return $this
     */
    final protected function addError(ServiceError $error): self
    {
        $this->serviceErrors[] = $error;

        return $this;
    }

    /**
     * Each service handler has to call request validation to be sure all supplied data is valid
     *
     * @param RequestImpl $request
     * @return bool
     */
    final protected function validateRequest(Request $request): bool
    {
        $this->lastValidationErrors = $request->validate();

        return count($this->lastValidationErrors) == 0;
    }

    /**
     * Just return result to the caller
     *
     * @param mixed $result
     * @param ServiceError ...$errors
     * @return ServiceResponse
     */
    final protected function createResponse($result, ?ServiceError ...$errors): ServiceResponse
    {
        return new ServiceResponse($result, array_merge($this->serviceErrors, $errors), $this->lastValidationErrors);
    }
}
