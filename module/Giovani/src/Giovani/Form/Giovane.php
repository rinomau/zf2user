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
        
        $send = new Element\Button('submit');
        $send->setLabel('Submit');
        $send->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($send);
        
    }
}