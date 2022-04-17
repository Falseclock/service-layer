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

class ServiceResponse
{
    /** @var ValidatorError[] */
    protected $requestErrors = [];
    /** @var ServiceError[] */
    protected $serviceErrors = [];
    /** @var mixed */
    protected $result;

    public function __construct($result, array $serviceErrors = [], array $requestErrors = [])
    {
        $this->result = $result;
        $this->serviceErrors = $serviceErrors;
        $this->requestErrors = $requestErrors;
    }

    /**
     * @return ServiceError[]
     */
    public function getServiceErrors(): array
    {
        return $this->serviceErrors;
    }

    /**
     * Check's whether request values are valid
     *
     * @return bool
     */
    public function isRequestValid(): bool
    {
        return count($this->requestErrors) == 0;
    }

    /**
     * Check's whether request values are NOT valid
     *
     * @return bool
     */
    public function isRequestInValid(): bool
    {
        return count($this->requestErrors) != 0;
    }

    /**
     * @return ValidatorError[]
     */
    public function getRequestErrors(): array
    {
        return $this->requestErrors;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param int $errorCode
     * @return bool
     */
    public function hasServerError(int $errorCode): bool
    {
        foreach ($this->serviceErrors as $error) {
            if ($error->getCode() == $errorCode) {
                return true;
            }
        }

        return false;
    }
}
