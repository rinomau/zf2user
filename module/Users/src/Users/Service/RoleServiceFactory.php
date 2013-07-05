<?php
namespace Users\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RoleServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \Contents\Service\ContentService;
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $am_conf = $serviceLocator->get('Config');
        $i_defaultRole = $am_conf['default_role_id'];
        $I_entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        if ($serviceLocator->get('zfcuser_auth_service')->hasIdentity()) {
            $I_role = $serviceLocator->get('zfcuser_auth_service')->getIdentity()->getRole();
        }
        else {
            $I_role = new \Users\Entity\Role();
        }
        
        return new RoleService($I_entityManager, $I_role, $i_defaultRole);
    }
}
