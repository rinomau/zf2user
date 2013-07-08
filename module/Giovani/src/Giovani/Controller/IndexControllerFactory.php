<?php
namespace Giovani\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \Users\Controller\IndexController;
     */
    public function createService(ServiceLocatorInterface $serviceLocator){
        $I_giovaniService = $serviceLocator->getServiceLocator()->get('Giovani\Service\GiovaniService');
        $as_config = $serviceLocator->getServiceLocator()->get('Config');
        
        $I_entityManager = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $meta = $em->getClassMetadata('\Giovani\Entity\Giovane'); 
        
        $I_giovaniForm = new \Giovani\Form\Giovane($meta->fieldMappings);
        $I_giovaniFormFilter = new \Giovani\Form\GiovaneFilter($I_entityManager);
        $I_giovaniForm->setInputFilter($I_giovaniFormFilter);
        $I_giovaniForm->setAttribute('action', '/users/process');
        
        return new IndexController($I_giovaniService,$I_giovaniForm,$as_config['MvaCrud']);
        
        
    }
}
