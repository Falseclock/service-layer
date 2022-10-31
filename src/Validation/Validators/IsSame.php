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

class IsSame extends ValidatorImpl
{
    public const ERROR_NO_MATCH = "No value to compare. Use 'against' function.";
    /** @var mixed */
    protected $against;

    /**
     * @param mixed $value
     * @return $this
     */
    public function against($value): IsSame
    {
        $this->against = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null): bool
    {
        if (is_null($value) && $this->nullable) {
            return true;
        }

        if (!isset($this->against))
            throw new ValidationException(self::ERROR_NO_MATCH);

        if ($value === $this->against) {
            return true;
        }

        return false;
    }
}
