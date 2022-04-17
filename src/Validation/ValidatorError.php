<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

use JsonSerializable;

final class ValidatorError implements JsonSerializable
{
    public const FIELD_MESSAGE = "message";
    public const FIELD_VALUE = "value";
    /** @var string */
    protected $message;
    /** @var mixed */
    protected $value;

    /**
     * ValidatorMessage constructor.
     *
     * @param string|null $message
     * @param mixed $value
     */
    public function __construct(string $message, $value = null)
    {
        $this->message = $message;
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            self::FIELD_MESSAGE => $this->getMessage(),
            self::FIELD_VALUE => $this->getValue(),
        ];
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
