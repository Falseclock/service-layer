<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-request
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

abstract class ValidatorImpl implements Validator
{
    /**
     * @var mixed Значение переменной устанавливается динамически
     * @see ValidationProcess::validate()
     */
    public $value;
    protected $message;

    /**
     * Validator constructor.
     *
     * @param string|null $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return ValidatorError
     */
    public function getMessage(): ValidatorError
    {
        return new ValidatorError($this->message, $this->value);
    }
}
