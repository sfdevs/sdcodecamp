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
            ->findBy(['visible' => true], ['title' => 'ASC']);

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    /**
     * @param $id
     * @param string $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{slug},{id}", name="session_show_by_slug")
     * @Route("/{id}", name="session_show")
     */
    public function showAction($id, $slug = '')
    {
        $session = $this->getDoctrine()
            ->getRepository('AppBundle:Session')
            ->find($id);
        if (!$session || !$session->isVisible()) {
            throw $this->createNotFoundException('Unable to find session');
        }
        if ($slug === '' || $slug !== $session->getSlug()) {
            return $this->redirectToRoute('session_show_by_slug', ['id' => $id, 'slug' => $session->getSlug()]);
        }

        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }
}
