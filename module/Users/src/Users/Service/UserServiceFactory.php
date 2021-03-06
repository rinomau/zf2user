<?php
namespace Users\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \Contents\Service\ContentService;
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $I_entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        
        return new UserService($I_entityManager);
    }
}
