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

abstract class Service
{
    /** @var ValidatorError[] */
    public array $lastValidationErrors = [];
    /** @var ServiceResponse */
    protected $response;
    /** @var ServiceError[] */
    protected array $serviceErrors = [];

    /**
     * Service constructor.
     *
     * @param mixed ...$arguments
     */
    public function __construct(...$arguments)
    {

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
     * @param ServiceError|null ...$errors
     * @return ServiceResponse
     */
    final protected function createResponse($result = null, ?ServiceError ...$errors): ServiceResponse
    {
        return new ServiceResponse($result, array_merge($this->serviceErrors, $errors), $this->lastValidationErrors);
    }
}
