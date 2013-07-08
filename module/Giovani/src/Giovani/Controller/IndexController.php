<?php

namespace Giovani\Controller;

use Zend\View\Model\ViewModel;

class IndexController extends \MvaCrud\Controller\CrudIndexController {

    public function __construct($I_service, $I_form,$as_config) {
        $entityName = 'Giovane';
        parent::__construct($entityName, $I_service, $I_form, $as_config);
    }
    
}
