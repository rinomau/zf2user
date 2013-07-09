<?php

namespace Giovani\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class Giovane extends Form
{
    
    public function __construct() {
        
        parent::__construct('Giovane');
        
        $id = new Element\Hidden('id');
        $this->add($id);
        
        $name = new Element\Text('nome');
        $name->setLabel('Nome');
        $this->add($name);
        
        $cognome = new Element\Text('cognome');
        $cognome->setLabel('Cognome');
        $this->add($cognome);
        
        $provenienza = new Element\Text('provenienza');
        $provenienza->setLabel('Provenienza');
        $this->add($provenienza);
        
        $canale = new Element\Text('canale');
        $canale->setLabel('Canale');
        $this->add($canale);
        
        $data_di_nascita = new Element\Text('data_di_nascita');
        $data_di_nascita->setLabel('Data di nascita');
        $this->add($data_di_nascita);
        
        $telefono = new Element\Text('telefono');
        $telefono->setLabel('Telefono');
        $this->add($telefono);
        
        $email = new Element\Text('email');
        $email->setLabel('Email');
        $this->add($email);
        
        $promotore = new Element\Text('promotore');
        $promotore->setLabel('Promotore');
        $this->add($promotore);
        
        $send = new Element\Button('submit');
        $send->setLabel('Submit');
        $send->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($send);
        
    }
}