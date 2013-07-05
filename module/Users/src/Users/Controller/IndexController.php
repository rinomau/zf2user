<?php

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends \MvaCrud\Controller\CrudIndexController {

    public function __construct($I_service, $I_form,$as_config) {
        $entityName = 'User';
        parent::__construct($entityName, $I_service, $I_form, $as_config);
    }
    
    public function rolesAction(){
        $aI_roles = $this->I_roleService->getAll();
        return new ViewModel(array(
            'users' => $aI_users,
            'flashMessages' => $this->flashMessenger()->setNamespace('user')->getMessages()
            ));
    }
}
/*
class IndexController extends AbstractActionController
{
    private $I_userService;
    private $I_roleService;
    private $I_userForm;
    
    public function __construct(\Users\Service\UserService $I_userService, \Users\Service\RoleService $I_roleService, \Zend\Form\Form $I_userForm) {
        $this->I_userService = $I_userService;
        $this->I_roleService = $I_roleService;
        $this->I_userForm = $I_userForm;
        $this->I_userForm->get('role')->setValueOptions($this->I_roleService->getAvailableUserRoles());
    }
    
    public function indexAction(){
        $aI_users = $this->I_userService->getAll();
        return new ViewModel(array(
            'users' => $aI_users,
            'flashMessages' => $this->flashMessenger()->setNamespace('user')->getMessages()
            ));
    }

    public function newAction(){
        $I_view = $this->getFormView('Inserisci nuovo utente');
        $this->I_userForm->get('isenabled')->setValue('1');
        return $I_view;
    }
    
    public function editAction(){
        $I_user = $this->CrudPlugin()->getEntity($this->I_userService);
        $this->I_userForm->get('id')->setValue($I_user->getId());
        $this->I_userForm->get('name')->setValue($I_user->getName());
        // $this->I_userForm->get('company')->setValue($I_user->getCompany());
        $this->I_userForm->get('isenabled')->setValue($I_user->getIsenabled());
        $this->I_userForm->get('email')->setValue($I_user->getEmail());
        // $this->I_userForm->get('password')->setValue($I_user->getPassword());
        $this->I_userForm->get('tel')->setValue($I_user->getTel());
        $this->I_userForm->get('role')->setValue($I_user->getRole()->getId());
        // $this->I_userForm->bind($I_user);
        $I_view = $this->getFormView('Modifica dati utente');
        return $I_view;
    }
    
    public function deleteAction(){
        $i_userid = $this->CrudPlugin()->getId();
        $this->I_userService->delete($i_userid);
        $this->flashMessenger()->setNamespace('user')->addMessage('Utente cancellato');
        $this->redirect()->toRoute('users');     
    }
    
    public function processAction () {
        if ($this->request->isPost()) {
            $as_post = $this->request->getPost()->toArray();
            $this->I_userForm->setData($as_post);
            
            if ( $as_post['id']>0 ){
                // Editing mode, remove required on password fields
                $this->I_userForm->getInputFilter()->get('password')->setRequired(false);
                $this->I_userForm->getInputFilter()->get('passwordVerify')->setRequired(false);
            }
            if( ! $this->I_userForm->isValid() ) {
                $I_view = $this->getFormView('Modifica dati utente');
                return $I_view;
            }

            $this->I_userService->save($as_post);
            
            if ($as_post['id']>0){
                $this->flashMessenger()->setNamespace('user')->addMessage('Dati di  '.$as_post['name'].' aggiornati');
            }
            else {
                $this->flashMessenger()->setNamespace('user')->addMessage($as_post['name'].' inserito');
            }

            $I_view = $this->getFormView('Modifica dati utente',true);
            return $I_view;

        }
        $this->CrudPlugin()->return404();
    }
    
    public function enableAction(){
        $i_id = (int) $this->params('id', null);
        if (null === $i_id) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $this->I_userService->enable($i_id);
        return $this->redirect()->toRoute('users');
    }
    
    public function disableAction(){
        $i_id = (int) $this->params('id', null);
        if (null === $i_id) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $this->I_userService->disable($i_id);
        return $this->redirect()->toRoute('users');
    }
    
    private function getFormView($s_title,$b_close=false){
        $I_view = new ViewModel(array(
                'form' => $this->I_userForm,
                'title' => $s_title,
                'close' => $b_close
                ));

        $I_view->setTemplate('users/index/form-content');
        $this->getEvent()->setParam('layout', 'modal');
        return $I_view;
    }

}
*/