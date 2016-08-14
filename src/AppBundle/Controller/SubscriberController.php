<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscriber;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SubscriberController extends SubscriberTypeController
{
    /**
     * @param Request $request
     * @return mixed
     *
     * @Route("/subscribe/", name="subscriber_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $subscriber = new Subscriber();
        $form = $this->createCreateForm($subscriber);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($subscriber);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Thank you for subscribing'
            );

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render("subscriber/new.html.twig", array(
            'subscriber' => $subscriber,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/subscribe/", name="subscriber_new")
     * @Method("GET")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $subscriber = new Subscriber();
        $form = $this->createCreateForm($subscriber);
        return $this->render("subscriber/new.html.twig", array(
            'subscriber' => $subscriber,
            'form' => $form->createView(),
        ));
    }
}
