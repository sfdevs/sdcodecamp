<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscriber;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 *
 * @package AppBundle\Controller
 */
class DefaultController extends SubscriberTypeController
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        // start building the response
        $response = new Response();
        $response->setEtag(md5('home'));
        $response->setPublic(); // make sure the response is public/cacheable
        $response->setMaxAge(3600);
        $response->setSharedMaxAge(3600);

        // Check that the Response is not modified for the given Request
        if ($response->isNotModified($request)) {
            // return the 304 Response immediately
            return $response;
        }
        return $this->render('default/index.html.twig', [], $response);
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
