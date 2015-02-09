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
        return $this->render('default/index.html.twig', array(
                'subscribe_form' => $form->createView(),
            ));
    }

    /**
     * @Route("/manifesto/", name="page_manifesto")
     */
    public function manifestoAction()
    {
        return $this->render('default/manifesto.html.twig');
    }
}
