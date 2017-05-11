<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 3/28/17
 * Time: 11:46 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Gruppi;
use AppBundle\Form\GruppiType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Persone controller.
 *
 * @Route("gruppi")
 */
class GruppiController extends Controller
{

    /**
     * Lists all squadre entities.
     *
     * @Route("/", name="gruppi_init",options={"expose"=true})
     * @Method("GET")
     */
    public function initAction()
    {
        return $this->render('base.html.twig');
    }
    /**
     * Lists all squadre entities.
     *
     * @Route("/index", name="gruppi_index",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gruppi = $em->getRepository('AppBundle:Gruppi')->findAll();
        return $this->render(':gruppi:index.html.twig', array(
            'gruppi' => $gruppi,
        ));
    }

    /**
     * Creates a new gruppi entity.
     *
     * @Route("/new", name="gruppi_new",options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $gruppi = new Gruppi();

        $form = $this->createForm('AppBundle\Form\GruppiType', $gruppi, array(
            'action' => $this->generateUrl('gruppi_new')));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($gruppi);
                $em->flush($gruppi);

                return $this->redirect($this->generateUrl('gruppi_index'));
            } else {
                return new Response(
                    $this->renderView(':gruppi:new.html.twig', array(
                        'gruppi' => $gruppi,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }

        return $this->render('gruppi/new.html.twig', array(
            'gruppi' => $gruppi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new gruppi entity.
     *
     * @Route("/new_2", name="gruppi_new_2",options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new2Action(Request $request)
    {
        $gruppi = new Gruppi();

        $form = $this->createForm('AppBundle\Form\Gruppi2Type', $gruppi, array(
            'action' => $this->generateUrl('gruppi_new_2')));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($gruppi);
                $em->flush($gruppi);

                return $this->redirect($this->generateUrl('gruppi_index'));
            } else {
                return new Response(
                    $this->renderView(':gruppi:new2.html.twig', array(
                        'gruppi' => $gruppi,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }

        return $this->render('gruppi/new2.html.twig', array(
            'gruppi' => $gruppi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing persone entity.
     * @Route("/{id}/edit", name="gruppi_edit",options={"expose"=true})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Gruppi $gruppo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request, Gruppi $gruppo)
    {
        $form = $this->createForm(GruppiType::class, $gruppo, array(
            'action' => $this->generateUrl('gruppi_edit', array('id' => $gruppo->getId()))));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush($gruppo);
                return $this->redirect($this->generateUrl('persone_index'));
            } else {
                return new Response(
                    $this->renderView(':gruppi:edit.html.twig', array(
                        'gruppo' => $gruppo,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }
        return $this->render('gruppi/edit.html.twig', array(
            'gruppo' => $gruppo,
            'form' => $form->createView(),
        ));
    }



}