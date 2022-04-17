<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation\Validators;

class IsUuid extends IsString
{
    /**
     * @param null $value
     * @param bool|null $nullable
     * @return bool
     * @noinspection RegExpSimplifiable
     */
    public function check($value = null, ?bool $nullable = false): bool
    {
        if (!parent::check($value, $nullable)) {
            return false;
        }

        if (is_null($value) && $nullable) {
            return true;
        }

        if ((preg_match('/^(?:[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}|00000000-0000-0000-0000-000000000000)$/', (string)$value) !== 1))
            return false;

        return true;
    }
}
