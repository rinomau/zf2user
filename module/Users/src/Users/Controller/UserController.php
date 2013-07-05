<?php

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    private $I_userService;
    private $I_roleService;
    private $I_contactForm;
    private $I_accessForm;
    private $I_registerForm;
    private $I_logoForm;
    private $s_rootPath;
    private $s_webPath;
    private $I_extensionvalidator;
    
    public function __construct($I_userService, $I_roleService, $I_contactForm, $I_accessForm, $I_registerForm, $I_logoForm, $s_rootPath, $s_webPath, $I_extensionvalidator) {
        $this->I_userService = $I_userService;
        $this->I_roleService = $I_roleService;
        $this->I_contactForm = $I_contactForm;
        $this->I_accessForm = $I_accessForm;
        $this->I_registerForm = $I_registerForm;
        $this->I_logoForm = $I_logoForm;
        $this->s_rootPath = $s_rootPath;
        $this->s_webPath = $s_webPath;
        $this->I_extensionvalidator = $I_extensionvalidator;
    }
    
    public function registerAction(){
        return new ViewModel(array(
            'registrationForm' => $this->I_registerForm
        ));
    }
    
    public function processRegisterAction(){
        if ($this->request->isPost()) {
            $as_post = $this->request->getPost()->toArray();
            $this->I_registerForm->setData($as_post);
            
            if( ! $this->I_registerForm->isValid() ) {
                $I_view = new ViewModel(array(
                    'registrationForm' => $this->I_registerForm
                    ));
                $I_view->setTemplate('users/user/register');
                return $I_view;
            }
            // Set default role
            $as_post['role'] = $this->I_roleService->getDefaultRoleId();
            // Create a custom password
            $s_pass = substr(md5(rand(0,9999)),rand(0,8),8);
            $as_post['password'] = $s_pass;
            // Set default state
            $as_post['state'] = '1';
            // Send email to the user
            $this->I_userService->sendPasswordToUser($as_post['email'],$as_post['password']);
            
            $this->I_userService->save($as_post);
            $this->flashMessenger()->setNamespace('systemuser')->addMessage('Ti abbiamo inviato la mail con la tua password all\'indirizzo indicato.');
            $this->redirect()->toUrl('/user/login');
            return ;
        }
        $this->CrudPlugin()->return404();
    }
    
    public function completaProfiloAction(){
        $b_close = false;
        if ($this->params()->fromQuery('close') == 'si') {
            $b_close = true;
        }
        $I_view = new ViewModel(array(
            'close' => $b_close
            ));
        $this->getEvent()->setParam('layout', 'modal');
        return $I_view;
    }
    
    public function sogliaMinimiAction(){
        $I_view = new ViewModel(array(
                      ));
        $this->getEvent()->setParam('layout', 'modal');
        return $I_view;
    }
    
    public function sovraFatturatoAction(){
        $I_view = new ViewModel(array(
                      ));
        $this->getEvent()->setParam('layout', 'modal');
        return $I_view;
    }
    
    public function detailAction()
    {
        $i_id = $this->zfcUserAuthentication()->getIdentity()->getId();
        $I_user = $this->I_userService->getEntity($i_id);
        $this->I_contactForm->bind($I_user);
        $this->I_accessForm->bind($I_user);
        $this->I_logoForm->bind($I_user);
        
        if ( strlen($I_user->getLogo())>3 ){
            if (file_exists($this->s_rootPath.$this->s_webPath.'/logo_'.$I_user->getId().'.jpg')){
                $s_logoImg = '<img src="'.$this->s_webPath.'/logo_'.$I_user->getId().'.jpg" alt="User Logo Image">';
            }
        }
        else {
            $s_logoImg = '&nbsp;';
        }

        return new ViewModel(array(
            'logoImg' => $s_logoImg,
            'user'=> $I_user,
            'contactForm' => $this->I_contactForm,
            'accessForm' => $this->I_accessForm,
            'logoForm' => $this->I_logoForm,
            'flashMessages' => $this->flashMessenger()->setNamespace('userdetail')->getMessages()
            ));
    }
    
    public function processAccessAction(){
        $i_id = $this->zfcUserAuthentication()->getIdentity()->getId();
        $I_user = $this->I_userService->getEntity($i_id);
        $this->I_contactForm->bind($I_user);
        
        if ($this->request->isPost()) {
            $as_post = $this->request->getPost()->toArray();
            $this->I_accessForm->setData($as_post);
            
            if ( $as_post['id']>0 ){
                // Editing mode, remove required on password fields
                $this->I_accessForm->getInputFilter()->get('password')->setRequired(false);
                $this->I_accessForm->getInputFilter()->get('passwordVerify')->setRequired(false);
            }
            if( ! $this->I_accessForm->isValid() ) {
                $I_view = new ViewModel(array(
                    'user'=>$I_user,
                    'contactForm' => $this->I_contactForm,
                    'accessForm' => $this->I_accessForm
                    ));
                $I_view->setTemplate('users/user/detail');
                return $I_view;
            }
            $this->I_userService->save($as_post);
            $this->flashMessenger()->setNamespace('userdetail')->addMessage('Dati aggiornati');
            $this->redirect()->toRoute('userdetail',array('action'=>'detail'));
            return ;
        }
        $this->CrudPlugin()->return404();
    }
    
    public function processContactAction(){
        $i_id = $this->zfcUserAuthentication()->getIdentity()->getId();
        $I_user = $this->I_userService->getEntity($i_id);
        $this->I_accessForm->bind($I_user);
        
        if ($this->request->isPost()) {
            $as_post = $this->request->getPost()->toArray();
            $this->I_contactForm->setData($as_post);
            
            if( ! $this->I_contactForm->isValid() ) {
                $I_view = new ViewModel(array(
                    'user'=>$I_user,
                    'contactForm' => $this->I_contactForm,
                    'accessForm' => $this->I_accessForm
                    ));
                $I_view->setTemplate('users/user/detail');
                return $I_view;
            }
            $this->I_userService->save($as_post);
            $this->flashMessenger()->setNamespace('userdetail')->addMessage('Dati aggiornati');
            $this->redirect()->toRoute('userdetail',array('action'=>'detail'));
            return ;
        }
        $this->CrudPlugin()->return404();
    }
    
    public function processLogoAction(){
        $i_id = $this->zfcUserAuthentication()->getIdentity()->getId();
        $I_user = $this->I_userService->getEntity($i_id);
        
        if ($this->request->isPost()) {
            $as_post = array_merge_recursive(
                            $this->request->getPost()->toArray(),          
                            $this->request->getFiles()->toArray()
                            );
            $as_post['id'] = $I_user->getId();
            $I_form = $this->I_logoForm;
            $I_form->setData($as_post);
            if(!$I_form->isValid()) {
                
                // I dati inviati non sono validi
                $I_view = new ViewModel( array( 
                    'logoImg' => '',
                    'user'=>$I_user,
                    'contactForm' => false,
                    'accessForm' => false,
                    'logoForm'  => $I_form,
                    'title' => 'Logo non valido'
                    ));
                $I_view->setTemplate('users/user/detail');
                return $I_view;
            }

            // Salvo il file se esiste
            if ( isset($as_post['logo']) && strlen($as_post['logo']['name']) > 0 ) {
                $I_adapter = new \Zend\File\Transfer\Adapter\Http();
                $I_adapter->setDestination($this->s_rootPath.$this->s_webPath);
                
                // Verifico le estensioni del file
                $I_adapter->setValidators(array($this->I_extensionvalidator), $as_post['logo']['name']);
                
                // Rinomino il file 
                $ext = pathinfo($as_post['logo']['name'], PATHINFO_EXTENSION);
                $I_adapter->addFilter('File\Rename', array('target' => $I_adapter->getDestination().'/'.$as_post['id'] . '.'.$ext, 'overwrite' => true));
                
                // Verifico che il file sia valido
                if ( !$I_adapter->isValid() ){
                    $dataError = $I_adapter->getMessages();
                    $errors = array();
                    foreach($dataError as $key => $row){
                        $errors[] = $row;
                    }
                    $I_form->setMessages(array('logo'=>$errors ));
                    
                    // Ripropongo la form con l'errore sul campo file
                    $I_model = new ViewModel(array(
                        'logoImg' => '',
                        'user'=> $I_user,
                        'contactForm' => false,
                        'accessForm' => false,
                        'logoForm' => $this->I_logoForm,
                        'flashMessages' => $this->flashMessenger()->setNamespace('userdetail')->getMessages()
                        ));

                    $I_model->setTemplate('users/user/detail');
                    return $I_model;
                }
                
                if ($I_adapter->receive($as_post['logo']['name'])) {
                    
                    $I_th_image = \MVA\Graphic\IMImage::loadFromFile($I_adapter->getFileName());
                    $I_th_image->resizeToFit(28, 28);
                    $I_th_image->saveAs($this->s_rootPath.$this->s_webPath.'/th_'.$as_post['id'] . '.jpg');
                    
                    $I_logo_image = \MVA\Graphic\IMImage::loadFromFile($I_adapter->getFileName());
                    $I_logo_image->resizeToFit(120, 120);
                    $I_logo_image->saveAs($this->s_rootPath.$this->s_webPath.'/logo_'.$as_post['id'] . '.jpg');
                    
                    if ( $as_post['id'] > 0 ){
                        $this->flashMessenger()->setNamespace('userdetail')->addMessage('Logo aggiornato');
                    }
                    else {
                        $this->flashMessenger()->setNamespace('userdetail')->addMessage('Logo inserito');
                    }
                    
                    // I dati della form sono validi, li salvo sul db
                    $I_systemuser = $this->I_userService->save($as_post);
                    
                    $this->redirect()->toRoute('userdetail',array('action'=>'detail'));
                }
                throw new \Exception('File upload failed');
                
            } 
            if ( $as_post['id'] > 0 ){
                $this->flashMessenger()->setNamespace('doc')->addMessage('Logo  aggiornato');
            }
            else {
                $this->flashMessenger()->setNamespace('doc')->addMessage('Logo inserito');
            }
            // 
            $this->redirect()->toRoute('userdetail',array('action'=>'detail'));
            
        }
        // Non sono arrivato da un post della form
        $this->getResponse()->setStatusCode(404);
        return;
    }

}
