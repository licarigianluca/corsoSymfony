<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Persone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Persone controller.
 *
 * @Route("persone")
 */
class PersoneController extends Controller
{
    /**
     * Lists all persone entities.
     *
     * @Route("/", name="persone_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $persones = $em->getRepository('AppBundle:Persone')->findAll();

        return $this->render('persone/index.html.twig', array(
            'persones' => $persones,
        ));
    }

    /**
     * Creates a new persone entity.
     *
     * @Route("/new", name="persone_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $persone = new Persone();
        $form = $this->createForm('AppBundle\Form\PersoneType', $persone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($persone);
            $em->flush($persone);

            return $this->redirectToRoute('persone_show', array('id' => $persone->getId()));
        }

        return $this->render('persone/new.html.twig', array(
            'persone' => $persone,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a persone entity.
     *
     * @Route("/{id}", name="persone_show")
     * @Method("GET")
     */
    public function showAction(Persone $persone)
    {
        $deleteForm = $this->createDeleteForm($persone);

        return $this->render('persone/show.html.twig', array(
            'persone' => $persone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing persone entity.
     *
     * @Route("/{id}/edit", name="persone_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Persone $persone)
    {
        $deleteForm = $this->createDeleteForm($persone);
        $editForm = $this->createForm('AppBundle\Form\PersoneType', $persone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('persone_edit', array('id' => $persone->getId()));
        }

        return $this->render('persone/edit.html.twig', array(
            'persone' => $persone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a persone entity.
     *
     * @Route("/{id}", name="persone_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Persone $persone)
    {
        $form = $this->createDeleteForm($persone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($persone);
            $em->flush($persone);
        }

        return $this->redirectToRoute('persone_index');
    }

    /**
     * Creates a form to delete a persone entity.
     *
     * @param Persone $persone The persone entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Persone $persone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('persone_delete', array('id' => $persone->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     *
     *
     * @Route("/{cognome}/esercizio", name="persone_esercizio")
     * @Method("GET")
     */
    public function esercizioAction($cognome)
    {
        $em = $this->getDoctrine()->getManager();

        $persones = $em->getRepository('AppBundle:Persone')->findAll();
//        $persones = $em->getRepository('AppBundle:Persone')->findOneByCognome($cognome);

        $flagTrovato = count($persones);

        foreach ($persones as $persona){
            $persona->setCognome('licari');
        }
        $em->flush();


        return $this->render('persone/indexEsercizio.html.twig', array(
            'persones' => $persones,
            'trovato' => $flagTrovato,
            'parametro' => $cognome,
        ));
    }


}
