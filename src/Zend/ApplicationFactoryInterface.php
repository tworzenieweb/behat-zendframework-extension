<?php
namespace Alteris\BehatZendframeworkExtension\Zend;

use Alteris\BehatZendframeworkExtension\Context\ContextAwareInterface;
use Zend\Mvc\ApplicationInterface;

interface ApplicationFactoryInterface
{
    /**
     * @param ContextAwareInterface $context
     * @return ApplicationInterface
     */
    public function factory(ContextAwareInterface $context);

    /**
     * @return string
     */
    public function getName();
}