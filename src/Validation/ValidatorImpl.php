<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

abstract class ValidatorImpl implements Validator
{
    /**
     * @var mixed Значение переменной устанавливается динамически
     * @see ValidationProcessImpl::validate()
     */
    public $value;
    /** @var string|null Error message */
    protected $message;
    /** @var bool */
    protected $nullable = false;

    /**
     * Validator constructor.
     *
     * @param string|null $message
     */
    public function __construct(string $message, ?bool $nullable = false)
    {
        $this->nullable = $nullable;
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
