<?php

namespace Users\Service;

use Zend\Permissions\Acl\Role\RoleInterface;
use Users\Entity\Systemuser;

class UserService extends \MvaCrud\Service\CrudService {

    public function __construct($I_entityManager) {
        $this->I_entityRepository  = $I_entityManager->getRepository('Users\Entity\Systemuser');
        $this->I_entityManager = $I_entityManager;
        $I_User = new Systemuser();

        parent::__construct($this->I_entityManager,$this->I_entityRepository,$I_User);
    }
    
}

/*
class UserService {
    
    private $I_entityManager;
    private $I_userRepository;
    private $I_role;
    private $I_mailService;
    private $as_transportOptions;
    
    public function __construct($I_entityManager, RoleInterface $I_role, $I_mailService, $transportOptions) {
        $this->I_entityManager = $I_entityManager;
        $this->I_role = $I_role;
        $this->I_userRepository = $I_entityManager->getRepository('Users\Entity\Systemuser');
        $this->I_mailService = $I_mailService;
        $this->as_transportOptions = $transportOptions;
    }
    
    public function getAll() {        
        return $this->I_userRepository->getAllUsers();
    }
    
    public function getEntity($id){
        return $this->I_userRepository->findOneBy(array('id' => $id,
                                                        'isvisible' => true));
    }

    public function save(array $am_formData){
        $I_user = NULL;
        if ($am_formData['id'] > 0){
            $I_user = $this->getEntity($am_formData['id']);
        }

        if (!isset($I_user)) {
            $I_user = new \Users\Entity\Systemuser();
        }

        if ( isset($am_formData['role']) ){
            $I_user->setRole($this->I_entityManager->getReference('\Users\Entity\Role', $am_formData['role']));
        }
        $I_user->exchangeArray($am_formData);
        
        $this->I_entityManager->persist($I_user);
        $this->I_entityManager->flush();
        return $I_user;
    }
    
    public function delete($i_id){
        $I_user = $this->I_userRepository->find($i_id);
        
        $I_user->setIsvisible(false);
        
        $this->I_entityManager->persist($I_user);
        $this->I_entityManager->flush();
    }
    
    public function enable($i_id){
        $I_user = $this->I_userRepository->find($i_id);
        $I_user->setIsenabled(true);
        $this->I_entityManager->persist($I_user);
        $this->I_entityManager->flush();
    }
    
    public function disable($i_id){
        $I_user = $this->I_userRepository->find($i_id);
        $I_user->setIsenabled(false);
        $this->I_entityManager->persist($I_user);
        $this->I_entityManager->flush();
    }
    
    public function getTendina(){
        $aI_users = $this->getAll();
        foreach ($aI_users as $user )
        {
            $as_users[$user->getId()] = $user->getName();
        }
        return $as_users;
    }

    public function sendPasswordToUser($s_to, $s_password)
    {
        // The template used by the PhpRenderer to create the content of the mail
        $viewTemplate = 'email/register';

        // The ViewModel variables to pass into the renderer
        $values = array('password' => $s_password);

        $mailService = $this->I_mailService;
        $s_from = $this->as_transportOptions['email'];
        $s_name = $this->as_transportOptions['name'];
        $message = $mailService->createTextMessage($s_from, $s_to, $s_name, $viewTemplate, $values);   
        $mailService->send($message);
    }
}
*/