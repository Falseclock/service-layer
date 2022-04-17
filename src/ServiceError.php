<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service;

class ServiceError
{
    public const ERROR_INVALID_REQUEST = 1000000;
    public const ERROR_UNEXPECTED = 1000001;
    /** @var int */
    protected $code;
    /** @var string */
    protected $message;

    public function __construct(string $message, int $code = 0)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
