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
     * Displays a form to edit an existing persone entity.
     *
     * @Route("/{id}/edit", name="gruppi_edit",options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     *
     * @param Request $request
     * @param Gruppi $gruppo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request, Gruppi $gruppo)
    {

//        $form = $this->createForm('AppBundle\Form\PersoneType', $persone);


        $form = $this->createForm(GruppiType::class, $gruppo, array(
            'action' => $this->generateUrl('gruppi_edit', array('id' => $gruppo->getId()))));


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                /* @var $em \Doctrine\ORM\EntityManager */
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