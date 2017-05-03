<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pazienti;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pazienti controller.
 *
 * @Route("pazienti")
 */
class PazientiController extends Controller
{
    /**
     * Lists all persone entities.
     *
     * @Route("/", name="pazienti_init",options={"expose"=true})
     * @Method("GET")
     */
    public function initAction()
    {

        return $this->render('base.html.twig');
    }

    /**
     * Lists all pazienti entities.
     *
     * @Route("/index", name="pazienti_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pazientis = $em->getRepository('AppBundle:Pazienti')->findAll();

        return $this->render('pazienti/index.html.twig', array(
            'pazientis' => $pazientis,
        ));
    }

    /**
     * Creates a new pazienti entity.
     *
     * @Route("/new", name="pazienti_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pazienti = new Pazienti();
        $form = $this->createForm('AppBundle\Form\PazientiType', $pazienti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pazienti);
            $em->flush();

            return $this->redirectToRoute('pazienti_show', array('id' => $pazienti->getId()));
        }

        return $this->render('pazienti/new.html.twig', array(
            'pazienti' => $pazienti,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pazienti entity.
     *
     * @Route("/{id}", name="pazienti_show")
     * @Method("GET")
     */
    public function showAction(Pazienti $pazienti)
    {
        $deleteForm = $this->createDeleteForm($pazienti);

        return $this->render('pazienti/show.html.twig', array(
            'pazienti' => $pazienti,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pazienti entity.
     *
     * @Route("/{id}/edit", name="pazienti_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pazienti $pazienti)
    {
        $deleteForm = $this->createDeleteForm($pazienti);
        $editForm = $this->createForm('AppBundle\Form\PazientiType', $pazienti);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pazienti_edit', array('id' => $pazienti->getId()));
        }

        return $this->render('pazienti/edit.html.twig', array(
            'pazienti' => $pazienti,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pazienti entity.
     *
     * @Route("/{id}", name="pazienti_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pazienti $pazienti)
    {
        $form = $this->createDeleteForm($pazienti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pazienti);
            $em->flush();
        }

        return $this->redirectToRoute('pazienti_index');
    }

    /**
     * Creates a form to delete a pazienti entity.
     *
     * @param Pazienti $pazienti The pazienti entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pazienti $pazienti)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pazienti_delete', array('id' => $pazienti->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
