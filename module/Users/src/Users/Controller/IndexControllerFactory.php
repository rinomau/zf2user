<?php
namespace Users\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \Users\Controller\IndexController;
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $I_userService = $serviceLocator->getServiceLocator()->get('Users\Service\UserService');
        $as_config = $serviceLocator->getServiceLocator()->get('Config');
        
        /*
        $I_roleService = $serviceLocator->getServiceLocator()->get('Users\Service\RoleService');
        */
        
        $I_entityManager = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meta = $em->getClassMetadata('\Users\Entity\Systemuser'); 
        
        $I_userForm = new \Users\Form\User($meta->fieldMappings);
        $I_userFormFilter = new \Users\Form\UserFilter($I_entityManager);
        $I_userForm->setInputFilter($I_userFormFilter);
        $I_userForm->setAttribute('action', '/users/process');
        
        return new IndexController($I_userService,$I_userForm,$as_config['MvaCrud']);
        
    }
}
