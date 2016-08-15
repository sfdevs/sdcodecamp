<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class SpeakerController
 *
 * @package AppBundle\Controller
 *
 * @Route("speakers")
 */
class SpeakerController extends Controller
{
    /**
     * @Route("/", name="speaker_index")
     */
    public function indexAction()
    {
        $speakers = $this->getDoctrine()
            ->getRepository('AppBundle:Speaker')
            ->findBy(['visible' => true]);

        return $this->render('speaker/index.html.twig', [
            'speakers' => $speakers,
        ]);
    }

    /**
     * @Route("/{id}", name="speaker_show")
     */
    public function showAction($id)
    {
        $speaker = $this->getDoctrine()
            ->getRepository('AppBundle:Speaker')
            ->find($id);
        if (!$speaker || !$speaker->isVisible()) {
            throw $this->createNotFoundException('Unable to find speaker');
        }

        return $this->render('speaker/show.html.twig', [
            'speaker' => $speaker,
        ]);
    }

}
