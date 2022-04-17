<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Example;

use Logger;
use Psr\Log\LoggerInterface;

class ExampleLogger implements LoggerInterface
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct()
    {
        $this->logger = Logger::getLogger("main");
    }

    public function emergency($message, array $context = array())
    {
        $this->logger->fatal($message);
    }

    public function alert($message, array $context = array())
    {
        $this->logger->warn($message);
    }

    public function critical($message, array $context = array())
    {
        $this->logger->fatal($message);
    }

    public function error($message, array $context = array())
    {
        $this->logger->error($message);
    }

    public function warning($message, array $context = array())
    {
        $this->logger->warn($message);
    }

    public function notice($message, array $context = array())
    {
        $this->logger->info($message);
    }

    public function info($message, array $context = array())
    {
        $this->logger->info($message);
    }

    public function debug($message, array $context = array())
    {
        $this->logger->debug($message);
    }

    public function log($level, $message, array $context = array())
    {
        $this->logger->info($message);
    }
}