<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Studenti
 *
 * @ORM\Table(name="studenti")
 * @ORM\Entity("")
 */
class Studenti
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
     * @var Classi
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classi",inversedBy="elencoStudenti")
     * @ORM\JoinColumn(name="id_classe", referencedColumnName="id")
     */
    private $idClasse;


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
     * @ORM\Column(name="dataNascita", type="date", nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="matricola", type="string", length=40, nullable=true )
     */
    private $matricola;

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
     * @return Classi
     */
    public function getIdClasse()
    {
        return $this->idClasse;
    }

    /**
     * @param Classi $idClasse
     */
    public function setIdClasse($idClasse)
    {
        $this->idClasse = $idClasse;
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
     * @return \DateTime
     */
    public function getDataNascita()
    {
        return $this->dataNascita;
    }

    /**
     * @param \DateTime $dataNascita
     */
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;
    }

    /**
     * @return string
     */
    public function getCodiceFiscale()
    {
        return $this->codiceFiscale;
    }

    /**
     * @param string $codiceFiscale
     */
    public function setCodiceFiscale($codiceFiscale)
    {
        $this->codiceFiscale = $codiceFiscale;
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
     * @return string
     */
    public function getMatricola()
    {
        return $this->matricola;
    }

    /**
     * @return string
     */
    public function getDescrizione()
    {
        return $this->matricola." ".$this->cognome." ".$this->nome;
    }

    /**
     * @param string $matricola
     */
    public function setMatricola($matricola)
    {
        $this->matricola = $matricola;
    }



}

