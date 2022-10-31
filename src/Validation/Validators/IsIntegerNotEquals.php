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

class IsIntegerNotEquals extends IsInteger
{
    public const ERROR_NOTHING_TO_COMPARE = "Nothing to compare";
    /** @var int */
    protected $against;

    /**
     * @param int $value
     * @return $this
     */
    public function against(int $value): IsIntegerNotEquals
    {
        $this->against = $value;

        return $this;
    }

    /**
     * @param null $value
     * @return bool
     * @throws ValidationException
     */
    public function check($value = null): bool
    {
        if (!parent::check($value)) {
            return true;
        }

        if (!isset($this->against)) {
            throw new ValidationException(self::ERROR_NOTHING_TO_COMPARE);
        }

        if ($value === $this->against)
            return false;

        return true;
    }
}
