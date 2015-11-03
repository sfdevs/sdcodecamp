<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscriber;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 *
 * @package AppBundle\Controller
 */
class DefaultController extends SubscriberTypeController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $subscriber = new Subscriber();
        $form = $this->createCreateForm($subscriber);
        return $this->render('default/index.html.twig',
            array(
                'subscribe_form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/information/", name="page_information")
     */
    public function informationAction()
    {
        return $this->render('default/information.html.twig');
    }

    /**
     * @Route("/venue/", name="page_venue")
     */
    public function venueAction()
    {
        return $this->render('default/venue.html.twig');
    }

    /**
     * @Route("/sponsors/", name="page_sponsors")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sponsorAction()
    {
        return $this->render('default/sponsor.html.twig');
    }

    /**
     * @Route("/schedule/", name="page_schedule")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function scheduleAction()
    {
        return $this->render('default/schedule.html.twig');
    }
}
