<?php

// src/AppBundle/Twig/AppExtension.php
namespace AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig_Environment;

class AppExtension extends \Twig_Extension
{


    protected $em;
    protected $stack;

    public function __construct(EntityManager $em, RequestStack $stack)
    {
        $this->em = $em;
        $this->stack = $stack;
    }


    public function getFunctions()
    {
        return array(
            'printTable' => new \Twig_SimpleFunction('stampaTabella', array($this, 'stampaTabella'),array('needs_environment' => true, 'is_safe' => array('html')))


        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter'))



        );
    }


    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function stampaTabella(Twig_Environment $env,$persone){




        return $env->render(":Template:stampaTabella.html.twig",array('persone' => $persone));
    }




    public function getName()
    {
        return 'app_extension';
    }
}