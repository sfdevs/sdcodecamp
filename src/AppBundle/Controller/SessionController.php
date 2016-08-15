<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class SessionController
 *
 * @package AppBundle\Controller
 *
 * @Route("/sessions")
 */
class SessionController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="session_index")
     */
    public function indexAction()
    {
        $sessions = $this->getDoctrine()
            ->getRepository('AppBundle:Session')
            ->findBy(['visible' => true]);

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{id}", name="session_show")
     */
    public function showAction($id)
    {
        $session = $this->getDoctrine()
            ->getRepository('AppBundle:Session')
            ->find($id);
        if (!$session || !$session->isVisible()) {
            throw $this->createNotFoundException('Unable to find session');
        }

        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }
}
