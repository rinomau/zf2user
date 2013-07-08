<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Giovani\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Giovane
 *
 * @ORM\Entity
 * @ORM\Table(name="giovani")
 *
 */
class Giovane
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $cognome;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $nome;
    
    /**
     * @var string
     * @ORM\Column(type="date", nullable=true)
     */
    protected $dataDiNascita;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $provenienza;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $canale;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $telefono;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;
    
    /**
     * @var string
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $promotore;


    public function getCognome() {
        return $this->cognome;
    }

    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getDataDiNascita() {
        return $this->dataDiNascita;
    }

    public function setDataDiNascita($dataDiNascita) {
        $this->dataDiNascita = $dataDiNascita;
        return $this;
    }

    public function getProvenienza() {
        return $this->provenienza;
    }

    public function setProvenienza($provenienza) {
        $this->provenienza = $provenienza;
        return $this;
    }

    public function getCanale() {
        return $this->canale;
    }

    public function setCanale($canale) {
        $this->canale = $canale;
        return $this;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getPromotore() {
        return $this->promotore;
    }

    public function setPromotore($promotore) {
        $this->promotore = $promotore;
        return $this;
    }

    




    /**
     * Get the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

}
