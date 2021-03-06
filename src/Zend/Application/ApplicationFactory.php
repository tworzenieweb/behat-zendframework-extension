<?php

namespace Alteris\BehatZendframeworkExtension\Zend\Application;

use Alteris\BehatZendframeworkExtension\Context\ContextAwareInterface;
use Alteris\BehatZendframeworkExtension\Zend\ApplicationFactoryInterface;
use Zend\Console\Console;
use Zend\Mvc\Application;
use Zend\Mvc\ApplicationInterface;

/**
 * Class ApplicationFactory
 * @package Alteris\BehatZendframeworkExtension\Zend
 */
class ApplicationFactory implements ApplicationFactoryInterface
{
    const NAME = 'zend_application';

    /**
     * @var string
     */
    private $configurationPath;

    /**
     * ApplicationFactory constructor.
     * @param string $configurationPath
     */
    public function __construct($configurationPath)
    {
        $this->configurationPath = $configurationPath;
    }



    /**
     * @param ContextAwareInterface $context
     * @return ApplicationInterface
     */
    public function factory(ContextAwareInterface $context)
    {
        Console::overrideIsConsole($context->isCliContext());
        $app = Application::init($this->getConfiguration());
        $events = $app->getEventManager();
        $app->getServiceManager()->get('SendResponseListener')->detach($events);

        return $app;
    }

    /**
     * @return array
     */
    private function getConfiguration()
    {
        $path = isset($this->configurationPath) ? $this->configurationPath : '';
        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf("Invalid path to configuration: '%s'", $path));
        }

        if (!isset($this->configurationPathConfig)) {
            $this->configurationPathConfig = require_once $path;
        }

        return $this->configurationPathConfig;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}
