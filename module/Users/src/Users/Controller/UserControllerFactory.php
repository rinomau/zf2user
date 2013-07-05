<?php
namespace Users\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \Users\Controller\UserController;
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $I_userService = $serviceLocator->getServiceLocator()->get('Users\Service\UserService');
        $I_roleService = $serviceLocator->getServiceLocator()->get('Users\Service\RoleService');
        $I_entityManager = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meta = $em->getClassMetadata('\Users\Entity\Systemuser'); 

        $I_contactForm = new \Users\Form\UserContact($meta->fieldMappings);
        $I_userContactFilter = new \Users\Form\UserContactFilter($I_entityManager);
        $I_contactForm->setInputFilter($I_userContactFilter);
        
        $I_accessForm = new \Users\Form\UserAccess($meta->fieldMappings);
        $I_userAccessFilter = new \Users\Form\UserAccessFilter($I_entityManager);
        $I_accessForm->setInputFilter($I_userAccessFilter);
        
        $I_registerForm = new \Users\Form\UserRegister($meta->fieldMappings);
        $I_userRegisterFilter = new \Users\Form\UserRegisterFilter($I_entityManager);
        $I_registerForm->setInputFilter($I_userRegisterFilter);
        
        $am_conf = $serviceLocator->getServiceLocator()->get('Config');
        $s_rootpath = $am_conf["logo_folder"]['root_folder'];
        $s_webpath = $am_conf["logo_folder"]['web_folder'];
        $a_file_extension = $am_conf["logo_folder"]['valid_extensions'];
        
        $I_logoForm = new \Users\Form\UserLogo($meta->fieldMappings,$a_file_extension);
        $I_logoFilter = new \Users\Form\UserLogoFilter($I_entityManager);
        $I_logoForm->setInputFilter($I_logoFilter);
        
        $I_extensionvalidator = new \Zend\Validator\File\Extension(array('extension'=>$a_file_extension));
        
        return new UserController($I_userService, $I_roleService, $I_contactForm, $I_accessForm, $I_registerForm, $I_logoForm, $s_rootpath, $s_webpath, $I_extensionvalidator);
        
    }
}
