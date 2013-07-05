<?php

namespace Users\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter {

public function __construct($I_entityManager) {
    
     $this->add(array(
            'name'       => 'name',
            'required'   => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name' => 'not_empty'
                    ),
                )
            )
        );

     $I_emailValidator = new \Users\Validator\NoObjectExists(array(
        'object_repository' => $I_entityManager->getRepository('Users\Entity\Systemuser'),
        'fields' => array('email'),
     ));
     
    $this->add(array(
        'name'       => 'email',
        'required'   => true,
        'validators' => array(
            array(
                'name' => 'EmailAddress'
            ),
            $I_emailValidator
        ),
    ));
        
    $this->add(array(
        'name'       => 'role',
        'required'   => true,
        'filters' => array(
            array('name' => 'StringTrim'),
            array('name' => 'StripTags'),
        ),
        'validators' => array(
            array(
                'name' => 'not_empty'
                ),
            )
        )
    );
       
    $this->add(array(
        'name'       => 'isenabled',
        'required'   => true,
        'filters' => array(
            array('name' => 'StringTrim'),
            array('name' => 'StripTags'),
        ),
        'validators' => array(
            array(
                'name' => 'not_empty'
                ),
            )
        )
    );
       
    $this->add(array(
        'name'       => 'password',
        'required'   => true,
        'filters'    => array(array('name' => 'StringTrim')),
        'validators' => array(
            array(
                'name'    => 'StringLength',
                'options' => array(
                    'min' => 6,
                ),
            ),
            array(
                'name'    => 'Identical',
                'options' => array(
                    'token' => 'passwordVerify',
                ),
            ),
        ),
    ));

    $this->add(array(
        'name'       => 'passwordVerify',
        'required'   => true,
        'filters'    => array(array('name' => 'StringTrim')),
        'validators' => array(
            array(
                'name'    => 'StringLength',
                'options' => array(
                    'min' => 6,
                ),
            ),
            array(
                'name'    => 'Identical',
                'options' => array(
                    'token' => 'password',
                ),
            ),
        ),
    ));

    }
}