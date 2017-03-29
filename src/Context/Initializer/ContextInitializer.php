<?php

namespace Alteris\BehatZendframeworkExtension\Context\Initializer;

use Alteris\BehatZendframeworkExtension\Context\ContextAwareInterface;
use Alteris\BehatZendframeworkExtension\Zend\ApplicationFactoryInterface;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer as BehatContextInitializer;
use Zend\Mvc\ApplicationInterface;

/**
 * Class ContextInitializer
 * @package Alteris\BehatZendframeworkExtension\Context\Initializer
 */
class ContextInitializer implements BehatContextInitializer
{
    /**
     * @var ApplicationFactoryInterface
     */
    private $factory;

    /**
     * ContextInitializer constructor.
     * @param ApplicationFactoryInterface $application
     */
    public function __construct(ApplicationFactoryInterface $factory)
    {
        $this->factory = $factory;
    }


    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        if ($context instanceof ContextAwareInterface) {
            $context->setApplication($this->factory->factory());
        }
    }
}
