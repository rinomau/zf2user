<?php

namespace Users\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class User extends Form
{
    
    public function __construct() {
        
        parent::__construct('User');
        
        $id = new Element\Hidden('id');
        $this->add($id);
        
        $name = new Element\Text('email');
        $name->setLabel('Email');
        $this->add($name);
        
        $I_password = new Element\Password('password');
        $I_password->setLabel('Password');
        $I_password->setAttributes(array('class' => 'medium'));
        $this->add($I_password);
        
        $I_passwordVerify = new Element\Password('passwordVerify');
        $I_passwordVerify->setLabel('Verifica password');
        $I_passwordVerify->setAttributes(array('class' => 'medium'));
        $this->add($I_passwordVerify);

        $send = new Element\Button('submit');
        $send->setLabel('Submit');
        $send->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($send);
        
    }
}