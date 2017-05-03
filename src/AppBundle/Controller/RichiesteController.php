<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Richieste;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Richieste controller.
 *
 * @Route("richieste")
 */
class RichiesteController extends Controller
{
    /**
     * Lists all richieste entities.
     *
     * @Route("/", name="richieste_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $richiestes = $em->getRepository('AppBundle:Richieste')->findAll();

        return $this->render('richieste/index.html.twig', array(
            'richiestes' => $richiestes,
        ));
    }

    /**
     * Creates a new richieste entity.
     *
     * @Route("/new", name="richieste_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $richieste = new Richieste();
        $form = $this->createForm('AppBundle\Form\RichiesteType', $richieste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($richieste);
            $em->flush();

            return $this->redirectToRoute('richieste_show', array('id' => $richieste->getId()));
        }

        return $this->render('richieste/new.html.twig', array(
            'richieste' => $richieste,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a richieste entity.
     *
     * @Route("/{id}", name="richieste_show")
     * @Method("GET")
     */
    public function showAction(Richieste $richieste)
    {
        $deleteForm = $this->createDeleteForm($richieste);

        return $this->render('richieste/show.html.twig', array(
            'richieste' => $richieste,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing richieste entity.
     *
     * @Route("/{id}/edit", name="richieste_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Richieste $richieste)
    {
        $deleteForm = $this->createDeleteForm($richieste);
        $editForm = $this->createForm('AppBundle\Form\RichiesteType', $richieste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('richieste_edit', array('id' => $richieste->getId()));
        }

        return $this->render('richieste/edit.html.twig', array(
            'richieste' => $richieste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a richieste entity.
     *
     * @Route("/{id}", name="richieste_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Richieste $richieste)
    {
        $form = $this->createDeleteForm($richieste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($richieste);
            $em->flush();
        }

        return $this->redirectToRoute('richieste_index');
    }

    /**
     * Creates a form to delete a richieste entity.
     *
     * @param richieste $richieste The richieste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Richieste $richieste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('richieste_delete', array('id' => $richieste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
