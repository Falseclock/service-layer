<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-request
 */

declare(strict_types=1);

namespace Falseclock\Service\Validation;

use Closure;

class ValidationProcess implements ValidationProcessInterface
{
    /** @var ValidatorError[] */
    protected $errors = [];
    /** @var ValidationElement[] */
    protected $elements = [];

    /**
     * @return ValidatorError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Добавление новой проверки значения
     *
     * @param string|array|callable $valueOrEnclosure
     * @param Validator[] $validators
     *
     * @return ValidationProcess
     */
    public function add($valueOrEnclosure, Validator ...$validators): ValidationProcess
    {
        foreach ($validators as $validator)
            $this->elements[] = new ValidationElement($valueOrEnclosure, $validator);

        return $this;
    }

    /**
     * @return ValidatorError[]
     */
    public function validate(): array
    {
        foreach ($this->elements as $element) {

            if ($element->valueOrEnclosure instanceof Closure && is_callable($element->valueOrEnclosure)) {
                $checkingValue = ($element->valueOrEnclosure)();
            } else {
                $checkingValue = $element->valueOrEnclosure;
            }

            /** @see ValidatorImpl::$value */
            $element->validator->value = $checkingValue;

            try {
                if ($element->validator->check($checkingValue) === false) {
                    $this->saveMessage($element->validator->getMessage());
                }
            } catch (ValidationException $t) {
                $this->saveMessage(new ValidatorError($t->getMessage()));
            }
        }

        return $this->errors;
    }

    /**
     * @param ValidatorError $message
     */
    private function saveMessage(ValidatorError $message): void
    {
        $this->errors[] = $message;
    }
}
