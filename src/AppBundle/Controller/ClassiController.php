<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Classi;
use AppBundle\Entity\Studenti;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Classi controller.
 *
 * @Route("classi")
 */
class ClassiController extends Controller
{
    /**
     * Lists all classi entities.
     *
     * @Route("/", name="classi_init",options={"expose"=true})
     * @Method("GET")
     */
    public function initAction()
    {
        return $this->render('base.html.twig');
    }


    /**
     * Lists all classi entities.
     *
     * @Route("/index", name="classi_index",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $classi = $em->getRepository('AppBundle:Classi')->findAll();

        return $this->render(':classi:index.html.twig', array(
            'classi' => $classi,
        ));
    }

    /**
     * Creates a new classi entity.
     *
     * @Route("/new", name="classi_new",options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $classi = new Classi();

        $form = $this->createForm('AppBundle\Form\ClassiType', $classi, array(
            'action' => $this->generateUrl('classi_new')));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($classi);
                $em->flush($classi);

                return $this->redirect($this->generateUrl('classi_index'));
            } else {
                return new Response(
                    $this->renderView(':classi:new.html.twig', array(
                        'classi' => $classi,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }

        return $this->render('classi/new.html.twig', array(
            'classi' => $classi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new classi entity.
     *
     * @Route("/new2", name="classi_new_2",options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newAction2(Request $request)
    {
        $classi = new Classi();

        $form = $this->createForm('AppBundle\Form\Classi2Type', $classi, array(
            'action' => $this->generateUrl('classi_new_2')));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $studenti = new ArrayCollection();

                foreach ($classi->getElencoStudenti() as $studente){
                    $temp = $em->getRepository('AppBundle:Studenti')->find($studente->getId());
                    $studenti->add($temp);
                }

                $em->persist($classi);
                $em->flush($classi);
                $em->refresh($classi);

                $studente = null;
                foreach ($studenti as $studente){

                    $studente->setIdClasse($classi);
                }
                $em->flush();
                return $this->redirect($this->generateUrl('classi_index'));
            } else {
                return new Response(
                    $this->renderView(':classi:new2.html.twig', array(
                        'classi' => $classi,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }

        return $this->render('classi/new2.html.twig', array(
            'classi' => $classi,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing classi entity.
     *
     * @Route("/{id}/edit", name="classi_edit",options={"expose"=true})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Classi $classi
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request, Classi $classi)
    {
        $form = $this->createForm('AppBundle\Form\ClassiType', $classi, array(
            'action' => $this->generateUrl('classi_edit', array('id' => $classi->getId()))));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
//                $em->flush($classi);
                $em->flush();
                return $this->redirect($this->generateUrl('classi_index'));
            } else {
                return new Response(
                    $this->renderView(':classi:edit.html.twig', array(
                        'classi' => $classi,
                        'form' => $form->createView()
                    ))
                    , 409);
            }
        }
        return $this->render('classi/edit.html.twig', array(
            'classi' => $classi,
            'form' => $form->createView(),
        ));
    }


    /**
     * Deletes a classi entity.
     *
     * @Route("/{id}/delete", name="classi_delete", options={"expose"=true})
     * @Method({"GET","DELETE"})
     *
     * @param Request $request
     * @param Classi $classi
     *
     * @return Response
     */
    public function deleteAction(Request $request,Classi $classi)
    {

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'DELETE') {

            $em->remove($classi);
            $em->flush();

            return $this->indexAction();
        }

        return $this->render(':classi:delete.html.twig', array(
            'entity' => $classi

        ));
    }


}
