<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service;

use Falseclock\Service\Validation\ValidationProcess;
use Falseclock\Service\Validation\ValidationProcessImpl;
use Falseclock\Service\Validation\Validator;
use Falseclock\Service\Validation\ValidatorError;
use stdClass;

abstract class RequestImpl implements Request
{
    /** @var ValidationProcess */
    protected $validationProcess;

    /**
     * Специально определяем конструктор, чтобы у нас везде в потомках конструктор был однотипный
     *
     * @param stdClass|null $stdClass $stdClass
     */
    public function __construct(?stdClass $stdClass = null)
    {
        if (!is_null($stdClass)) {
            $this->parseObject($stdClass);
        }
    }

    /**
     * @param $object
     */
    private function parseObject($object)
    {
        foreach ($object as $key => $value) {
            if (property_exists($this, $key))
                $this->$key = $value;
        }
    }

    /**
     * @return ValidationProcess
     */
    public function getValidationProcess(): ValidationProcess
    {
        return $this->validationProcess;
    }

    /**
     * @return bool
     */
    final public function isValid(): bool
    {
        $this->validate();

        if (is_null($this->validationProcess)) {
            return true;
        }

        return count($this->validationProcess->getErrors()) == 0;
    }

    /**
     * Как правило, вызывается из сервиса перед тем, как начать оперировать запросом,
     * либо может быть вызван из юнит тестов или от куда-то еще
     *
     * @return ValidatorError[]
     * @see Service::validateRequest();
     */
    final public function validate(): array
    {
        // Обнуляем валидейшин процесс, так как гипотетически мы можем валидировать один и тот же реквест несколько раз
        $this->clearValidationProcess();

        // Инициируем валидаторы
        $this->initiateValidation();

        if (!is_null($this->validationProcess)) {
            return $this->validationProcess->validate();
        }

        return [];
    }

    /**
     * @return $this
     */
    public function clearValidationProcess(): RequestImpl
    {
        $this->validationProcess = null;

        return $this;
    }

    /**
     * @return ValidatorError[]
     */
    public function getErrors(): array
    {
        if (is_null($this->validationProcess)) {
            return [];
        }
        return $this->validationProcess->getErrors();
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
    }

    /**
     * Данный метод вызывается несколько раз на все поля в initValidators методе
     *
     * @param mixed $checkingValue
     * @param Validator ...$validators
     *
     * @see RequestImpl::initiateValidation()
     */
    protected function addValidator($checkingValue, Validator ...$validators)
    {
        if (is_null($this->validationProcess)) {
            $this->validationProcess = new ValidationProcessImpl();
        }

        foreach ($validators as $validator) {
            $this->validationProcess->add($checkingValue, $validator);
        }
    }
}
