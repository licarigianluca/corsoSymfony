<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 3/21/17
 * Time: 11:38 AM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Pazienti
 *
 * @ORM\Table(name="pazienti")
 * @ORM\Entity()
 */
class Pazienti
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cognome", type="string", length=255)
     */
    private $cognome;

    /**
     * @var date
     *
     * @ORM\Column(name="data_nascita", type="date")
     */
    private $dataNascita;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Richieste", mappedBy="idPaziente", cascade={"persist"})
     *
     */
    private $elencoRichieste;

    public function __construct()
    {
        $this->elencoRichieste = new ArrayCollection();

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * @param string $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
     * @return date
     */
    public function getDataNascita()
    {
        return $this->dataNascita;
    }

    /**
     * @param date $dataNascita
     */
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;
    }

    /**
     * @return ArrayCollection
     */
    public function getElencoRichieste()
    {
        return $this->elencoRichieste;
    }

    /**
     * @param ArrayCollection $elencoRichieste
     */
    public function setElencoRichieste($elencoRichieste)
    {
        $this->elencoRichieste = $elencoRichieste;
    }

public function getNominativo()

{
   return $this->id.' '.$this->nome;
}






}