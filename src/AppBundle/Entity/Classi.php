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
 * Classi
 *
 * @ORM\Table(name="classi")
 * @ORM\Entity()
 */
class Classi
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
     * @ORM\Column(name="descrizione", type="string", length=255)
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Studenti", mappedBy="idClasse", cascade={"persist"})
     *
     */
    private $elencoStudenti;

    public function __construct()
    {
        $this->elencoStudenti = new ArrayCollection();

    }

    /**
     * @return ArrayCollection
     */
    public function getElencoStudenti()
    {
        return $this->elencoStudenti;
    }

    /**
     * @param ArrayCollection $elencoStudenti
     */
    public function setElencoStudenti($elencoStudenti)
    {
        $this->elencoStudenti = $elencoStudenti;
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

}