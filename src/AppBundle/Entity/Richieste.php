<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Richieste
 *
 * @ORM\Table(name="richieste")
 * @ORM\Entity()
 */
class Richieste
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
     * @var Pazienti
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pazienti",inversedBy="elencoRichieste")
     * @ORM\JoinColumn(name="id_paziente", referencedColumnName="id")
     */
    private $idPaziente;


    /**
     * @var string
     *
     * @ORM\Column(name="codice", type="string", length=50)
     */
    private $codice;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=255)
     */
    private $descrizione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataRichiesta", type="date")
     */
    private $dataRichiesta;

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
     * @return Pazienti
     */
    public function getIdPaziente()
    {
        return $this->idPaziente;
    }

    /**
     * @param Pazienti $idPaziente
     */
    public function setIdPaziente($idPaziente)
    {
        $this->idPaziente = $idPaziente;
    }

    /**
     * @return string
     */
    public function getCodice()
    {
        return $this->codice;
    }

    /**
     * @param string $codice
     */
    public function setCodice($codice)
    {
        $this->codice = $codice;
    }

    /**
     * @return string
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * @param string $descrizione
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }

    /**
     * @return \DateTime
     */
    public function getDataRichiesta()
    {
        return $this->dataRichiesta;
    }

    /**
     * @param \DateTime $dataRichiesta
     */
    public function setDataRichiesta($dataRichiesta)
    {
        $this->dataRichiesta = $dataRichiesta;
    }



}

