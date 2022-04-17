<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

use Falseclock\Service\Validation\ValidatorImpl;

class IsInstanceOf extends ValidatorImpl
{
    /** @var string */
    protected $class;

    /**
     * @param $value
     * @param bool|null $nullable
     * @return bool
     */
    public function check($value = null, ?bool $nullable = false): bool
    {
        if (is_null($value) && $nullable) {
            return true;
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
