<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscriber;
use AppBundle\Form\SubscriberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SubscriberTypeController extends Controller
{
    /**
     * @param Subscriber $subscriber
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function createCreateForm(Subscriber $subscriber)
    {
        $form = $this->createForm('AppBundle\Form\SubscriberType', $subscriber, array(
            'action' => $this->generateUrl("subscriber_create"),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));
        return $form;
    }
}
