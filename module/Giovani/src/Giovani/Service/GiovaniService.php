<?php

namespace Giovani\Service;
use Giovani\Entity\Giovane;

/**
 * Description of DocumentService
 *
 * @author Mauro
 */
class GiovaniService extends \MvaCrud\Service\CrudService {

    public function __construct($I_entityManager) {
        $this->I_entityRepository  = $I_entityManager->getRepository('\Giovani\Entity\Giovane');
        $this->I_entityManager = $I_entityManager;
        $I_Giovane = new Giovane();

        parent::__construct($this->I_entityManager,$this->I_entityRepository,$I_Giovane);
    }
    

}