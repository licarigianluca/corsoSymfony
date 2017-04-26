<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Studenti;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Studenti controller.
 *
 * @Route("studenti")
 */
class StudentiController extends Controller
{
    /**
     * Lists all studenti entities.
     *
     * @Route("/", name="studenti_init",options={"expose"=true})
     * @Method("GET")
     */
    public function initAction()
    {
        return $this->render('base.html.twig');
    }


    /**
     * Lists all studenti entities.
     *
     * @Route("/index", name="studenti_index",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $studenti = $em->getRepository('AppBundle:Studenti')->findAll();

        return $this->render(':studenti:index.html.twig', array(
            'studenti' => $studenti,
        ));
    }

    /**
     * Creates a new studenti entity.
     *
     * @Route("/new", name="studenti_new",options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $studenti = new Studenti();

        $form = $this->createForm('AppBundle\Form\StudentiType', $studenti, array(
            'action' => $this->generateUrl('studenti_new')));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($studenti);
                $em->flush($studenti);

                return $this->redirect($this->generateUrl('studenti_index'));
            } else {
                return new Response(
                    $this->renderView(':studenti:new.html.twig', array(
                        'studenti' => $studenti,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }

        return $this->render('studenti/new.html.twig', array(
            'studenti' => $studenti,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing studenti entity.
     *
     * @Route("/{id}/edit", name="studenti_edit",options={"expose"=true})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Studenti $studenti
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request, Studenti $studenti)
    {
        $form = $this->createForm('AppBundle\Form\StudentiType', $studenti, array(
            'action' => $this->generateUrl('studenti_edit', array('id' => $studenti->getId()))));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush($studenti);
                return $this->redirect($this->generateUrl('studenti_index'));
            } else {
                return new Response(
                    $this->renderView(':studenti:edit.html.twig', array(
                        'studenti' => $studenti,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }
        return $this->render('studenti/edit.html.twig', array(
            'studenti' => $studenti,
            'form' => $form->createView(),
        ));
    }


    /**
     * Deletes a studenti entity.
     *
     * @Route("/{id}/delete", name="studenti_delete", options={"expose"=true})
     * @Method({"GET","DELETE"})
     *
     * @param Request $request
     * @param Studenti $studenti
     *
     * @return Response
     */
    public function deleteAction(Request $request,Studenti $studenti)
    {

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'DELETE') {

            $em->remove($studenti);
            $em->flush();

            return $this->indexAction();
        }

        return $this->render(':studenti:delete.html.twig', array(
            'entity' => $studenti

        ));
    }


}
