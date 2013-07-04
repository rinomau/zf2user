<?php
namespace Users;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getControllerConfig() {
        return array(
            'factories' => array(
                'Users\Controller\Index' => 'Users\Controller\IndexControllerFactory',
                'Users\Controller\User' => 'Users\Controller\UserControllerFactory',            
            )
        );
    }
    
    public function getServiceConfig() {
        
        return array(
            'factories' => array(
                'Users\Service\UserService' => 'Users\Service\UserServiceFactory',
                'Users\Service\RoleService' => 'Users\Service\RoleServiceFactory',
                //'zfcuser_user_mapper' => 'Users\Mapper\UserMapperFactory',    //override ZfcUserDoctrineORM service configuration key
            ),
        );
        
    }
    
    public function getViewHelperConfig(){
        return array(
            'invokables' => array(
                'displayEnableLink' => 'Users\View\Helper\DisplayEnableLink',
            )
        );
    }
    
}
