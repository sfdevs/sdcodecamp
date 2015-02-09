<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscriber;
use AppBundle\Form\SubscriberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SubscriberTypeController extends Controller
{
    /**
     * @param Subscriber $subscriber
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function createCreateForm(Subscriber $subscriber)
    {
        $form = $this->createForm(new SubscriberType(), $subscriber, array(
                'action' => $this->generateUrl("subscriber_create"),
                'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Submit'));
        return $form;
    }
}