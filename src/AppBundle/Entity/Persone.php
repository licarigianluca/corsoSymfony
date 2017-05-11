<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persone
 *
 * @ORM\Table(name="persone")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersoneRepository")
 */
class Persone
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

//    /**
//     * @var Gruppi
//     *
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gruppi",inversedBy="elencoPersone")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="id_gruppo", referencedColumnName="id")
//     * })
//     */

    /**
     * @var Gruppi
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gruppi",inversedBy="elencoPersone")
     * @ORM\JoinColumn(name="id_gruppo", referencedColumnName="id")
     */
    private $idGruppo;


    /**
     * @var Squadre
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Squadre",inversedBy="elencoPersone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_squadra", referencedColumnName="id")
     * })
     */
    private $idSquadra;



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
     * @var \DateTime
     *
     * @ORM\Column(name="dataNascita", type="date",  nullable=true)
     */
    private $dataNascita;

    /**
     * @var string
     *
     * @ORM\Column(name="codiceFiscale", type="string", length=16, nullable=true)
     */
    private $codiceFiscale;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=true )
     */
    private $email;


    /**
     * Get id
     *
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Persone
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set cognome
     *
     * @param string $cognome
     *
     * @return Persone
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;

        return $this;
    }

    /**
     * Get cognome
     *
     * @return string
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * Get cognome
     *
     * @return string
     */
    public function getDescrizione()
    {
        return $this->cognome.' '.$this->nome.' '.$this->codiceFiscale;
    }


    /**
     * Set dataNascita
     *
     * @param \DateTime $dataNascita
     *
     * @return Persone
     */
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;

        return $this;
    }

    /**
     * Get dataNascita
     *
     * @return \DateTime
     */
    public function getDataNascita()
    {
        return $this->dataNascita;
    }

    /**
     * Set codiceFiscale
     *
     * @param string $codiceFiscale
     *
     * @return Persone
     */
    public function setCodiceFiscale($codiceFiscale)
    {
        $this->codiceFiscale = $codiceFiscale;

        return $this;
    }

    /**
     * Get codiceFiscale
     *
     * @return string
     */
    public function getCodiceFiscale()
    {
        return $this->codiceFiscale;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return Gruppi
     */
    public function getIdGruppo()
    {
        return $this->idGruppo;
    }

    /**
     * @param Gruppi $idGruppo
     */
    public function setIdGruppo($idGruppo)
    {
        $this->idGruppo = $idGruppo;
    }

    /**
     * @return Squadre
     */
    public function getIdSquadra()
    {
        return $this->idSquadra;
    }
    /**
     * @param Squadre $idSquadra
     */
    public function setIdSquadra($idSquadra)
    {
        $this->idSquadra = $idSquadra;
    }
}

