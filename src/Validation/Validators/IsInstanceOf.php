<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

use Falseclock\Service\Validation\ValidationException;
use Falseclock\Service\Validation\ValidatorImpl;

class IsInstanceOf extends ValidatorImpl
{
    public const ERROR_NOT_CLASS_DEFINED = "No class defined";

    /** @var string */
    protected $class;

    /**
     * @param $value
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null): bool
    {
        if (is_null($value) && $this->nullable) {
            return true;
        }

        if (is_null($this->class)) {
            throw new ValidationException(self::ERROR_NOT_CLASS_DEFINED);
        }

        return $value instanceof $this->class;
    }

    /**
     * @param string $className
     * @return $this
     */
    public function class(string $className): IsInstanceOf
    {
        $this->class = $className;

        return $this;
    }
}
