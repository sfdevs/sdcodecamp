<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscriber;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
}
