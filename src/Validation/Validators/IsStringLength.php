<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2023 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

use Falseclock\Service\Validation\ValidationException;

class IsStringLength extends IsString
{
    /** @var int */
    protected $max;
    /** @var int */
    protected $min;

    /**
     * @param $value
     *
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null): bool
    {
        if (!parent::check($value)) {
            return false;
        }

        if (!isset($this->min) and !isset($this->max))
            throw new ValidationException("Не установлены значения минимум или максимум");

        if (is_null($value) && $this->nullable)
            return true;

        $length = mb_strlen($value);

        if (isset($this->min) and !isset($this->max))
            return $length >= $this->min;

        else if (!isset($this->min) and isset($this->max))
            return $length <= $this->max;

        else
            return $length >= $this->min && $length <= $this->max;
    }

    /**
     * @param int $maximumLength
     *
     * @return $this
     */
    public function max(int $maximumLength): self
    {
        $this->max = $maximumLength;

        return $this;
    }

    /**
     * @param int $minimumLength
     *
     * @return $this
     */
    public function min(int $minimumLength): self
    {
        $this->min = $minimumLength;

        return $this;
    }
}
