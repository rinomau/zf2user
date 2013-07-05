<?php

namespace Users\Service;

use Zend\Permissions\Acl\Role\RoleInterface;

/**
 * Description of DocumentService
 *
 * @author Mauro
 */
class RoleService {
    
    private $I_entityManager;
    private $I_roleRepository;
    private $I_role;
    private $i_defaultroleId;
    
    public function __construct($I_entityManager, RoleInterface $I_role, $i_defaultRoleId) {
        $this->I_entityManager = $I_entityManager;
        $this->I_role = $I_role;
        $this->i_defaultroleId = $i_defaultRoleId;
        $this->I_roleRepository = $I_entityManager->getRepository('Users\Entity\Role');
    }
    
    public function getDefaultRole(){
        return $this->I_roleRepository->find($this->i_defaultroleId);
    }
    
    public function getDefaultRoleId(){
        return $this->i_defaultroleId;
    }
    
    public function getRoles() {
        return $this->I_roleRepository->getRoles();
    }
    
    public function toBasicArray($aI_roles=null){
        if ( $aI_roles == null ){
            $aI_roles = $this->getRoles();
        }

        foreach ($aI_roles as $role ){
            $as_roles[$role->getId()] = $role->getName();
        }
        return $as_roles;
    }
    
    public function getAvailableUserRoles(){
        $aI_roles = $this->I_roleRepository->getAvailableUserRoles();
        return $this->toBasicArray($aI_roles);
    }
}