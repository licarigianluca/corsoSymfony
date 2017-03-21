<?php
/**
 * Created by PhpStorm.
 * User: Tony Lorefice
 * Date: 21/02/2017
 * Time: 13:36
 */

namespace AppBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class ServizioCerca
{

    private $em;
    private $session;
    private $log;


    /**
     * ServizioCerca constructor.
     * @param $em
     * @param $log
     * @param $session
     */
    public function __construct(EntityManager $em, $session, LogExample $log)
    {
        $this->em = $em;
        $this->log = $log;
        $this->session = $session;
    }

    /*
       $em = $this->getDoctrine()->getManager();

        $persones = $em->getRepository('AppBundle:Persone')->findAll();

     * */

    public function DBmanager(){
        
       $persones = $this->em->getRepository('AppBundle:Persone')->findAll();

        $flagTrovato = count($persones);
        $this->log->log(' trovato '. $flagTrovato . ' ciao persone');

        foreach ($persones as $persona){
            $persona->setCognome('pippo');
        }
        $this->em->flush();

        return $persones;

    }

}