<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Gruppi;
use AppBundle\Entity\Persone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Persone Controller
 *
 * @Route("/select2")
 *
 */
class Select2Controller extends Controller
{

    /**
     * @Route("/classi", name="select2_classi")
     * @Method("GET")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function classiAction(Request $request)
    {
        $termine = strtolower($request->query->get('q'));
        $data = [];
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('c')
            ->from('AppBundle:Classi', 'c')
            ->where('UPPER(c.nome) LIKE UPPER(:nome)')
            ->setParameter('nome', '%' . $termine . '%')
            ->getQuery();
        $classi = $query->getResult();
        /**
         *
         * @var  $gruppo Gruppi
         */
        foreach ($classi as $key => $classe) {
            if (strpos(strtolower($classe->getNome()), $termine) >= 0) {
                $data[] = ['id' => $classe->getId(), 'text' => $classe->getNome()];
            }
        }
        return JsonResponse::create($data);
    }

    /**
     * @Route("/gruppi", name="select2_gruppi")
     * @Method("GET")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function gruppiAction(Request $request)
    {
        $termine = strtolower($request->query->get('q'));
        $data = [];
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('g')
            ->from('AppBundle:Gruppi', 'g')
            ->where('UPPER(g.descrizione) LIKE UPPER(:descrizione)')
            ->setParameter('descrizione', '%' . $termine . '%')
            ->getQuery();
        $gruppi = $query->getResult();
        /**
         *
         * @var  $gruppo Gruppi
         */
        foreach ($gruppi as $key => $gruppo) {
            if (strpos(strtolower($gruppo->getDescrizione()), $termine) >= 0) {
                $data[] = ['id' => $gruppo->getId(), 'text' => $gruppo->getDescrizione()];
            }
        }
        return JsonResponse::create($data);
    }

    /**
     * @Route("/persone", name="select2_persone")
     * @Method("GET")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function personeAction(Request $request)
    {
        $termine = strtolower($request->query->get('q'));
        $data = [];
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('p')
            ->from('AppBundle:Persone', 'p')
            ->where('UPPER(p.cognome) LIKE UPPER(:descrizione)')
            ->setParameter('descrizione', '%' . $termine . '%')
            ->getQuery();
        $persone = $query->getResult();
        /**
         *
         * @var  $persona Persone
         */
        foreach ($persone as $key => $persona) {
            if (strpos(strtolower($persona->getCognome()), $termine) >= 0) {
                $data[] = ['id' => $persona->getId(), 'text' => $persona->getPersone()];
            }
        }
        return JsonResponse::create($data);
    }
    /**
     * @Route("/squadre", name="select2_squadre")
     * @Method("GET")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function squadreAction(Request $request)
    {
        $termine = strtolower($request->query->get('q'));
        $data = [];
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('s')
            ->from('AppBundle:Squadre','s')
            ->where('UPPER(s.nome) LIKE UPPER(:nome)')
            ->setParameter('nome', '%' . $termine . '%')
            ->getQuery();
        $squadre = $query->getResult();
        /**
         * @var  $squadre Squadre
         */
        foreach ($squadre as $key => $squadra) {
            if (strpos(strtolower($squadra->getDescrizione()), $termine) >= 0) {
                $data[] = ['id' => $squadra->getId(), 'text' => $squadra->getNome()];
            }
        }
        return JsonResponse::create($data);
    }


    /**
     * @Route("/studenti", name="select2_studenti")
     * @Method("GET")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function studentiAction(Request $request)
    {
        $termine = strtolower($request->query->get('q'));
        $data = [];
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('s')
            ->from('AppBundle:Studenti', 's')
            ->where('UPPER(s.cognome) LIKE UPPER(:cognome)')
            ->andWhere('s.idClasse is null')
            ->setParameter('cognome', '%' . $termine . '%')
            ->getQuery();
        $studenti = $query->getResult();
        /**
         *
         * @var  $persona Persone
         */
        foreach ($studenti as $key => $studente) {
            if (strpos(strtolower($studente->getCognome()), $termine) >= 0) {
                $data[] = ['id' => $studente->getId(), 'text' => $studente->getDescrizione()];
            }
        }
        return JsonResponse::create($data);
    }
}
