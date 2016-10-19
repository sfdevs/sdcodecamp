<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\GoneHttpException;

/**
 * Class DefaultController.
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
        $response = $this->render('default/index.html.twig');
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);
        $response->isNotModified($request);

        return $response;
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
    public function venueAction(Request $request)
    {
        $response = $this->render('default/venue.html.twig', [
            'mapbox_project_id' => $this->getParameter('mapbox_project_id'),
            'mapbox_access_token' => $this->getParameter('mapbox_access_token'),
        ]);
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);
        $response->isNotModified($request);

        return $response;
    }

    /**
     * @Route("/schedule/family/", name="page_family")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function familyInfoAction(Request $request)
    {
        $response = $this->render('default/family.html.twig');
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);
        $response->isNotModified($request);

        return $response;
    }

    /**
     * @Route("/sponsors/", name="page_sponsors")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sponsorAction(Request $request)
    {
        $response = $this->render('default/sponsor.html.twig');
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);
        $response->isNotModified($request);

        return $response;
    }

    /**
     * @Route("/code-of-conduct/", name="page_code_of_conduct")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function codeOfConductAction(Request $request)
    {
        $response = $this->render('default/code-of-conduct.html.twig');
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);
        $response->isNotModified($request);

        return $response;
    }

    /**
     * @Route("/about-us/", name="page_about_us")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutUsAction(Request $request)
    {
        $response = $this->render('default/about-us.html.twig');
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);

        return $response;
    }

    /**
     * @Route("/sitemap.{_format}", name="page_sitemap",
     * defaults={"_format": "xml"},
     *     requirements={
     *         "_format": "xml",
     *     }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function siteMapAction()
    {
        $response = $this->createCachedResponse();
        $response->setEtag(md5('sitemap'));
        $sessions = $this->getDoctrine()->getRepository('AppBundle:Session')->findBy(['visible' => true]);
        $speakers = $this->getDoctrine()->getRepository('AppBundle:Session')->findBy(['visible' => true]);

        return $this->render(':default:sitemap.xml.twig', [
            'sessions' => $sessions,
            'speakers' => $speakers,
        ], $response);
    }

    /**
     * @Route("/schedule/", name="page_schedule")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function scheduleAction(Request $request)
    {
        $response = $this->render('default/schedule.html.twig');
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);
        $response->isNotModified($request);

        return $response;
    }

    /**
     * @Route("/open-spaces/", name="page_open_space")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function openSpaceAction(Request $request)
    {
        $response = $this->render('default/open-spaces.html.twig');
        $response->setEtag(md5($response->getContent()));
        $response = $this->createCachedResponse($response);
        $response->isNotModified($request);

        return $response;
    }

    private function createCachedResponse(Response $response = null)
    {
        if ($response === null) {
            $response = new Response();
        }
        $response->setPublic(); // make sure the response is public/cacheable
        $response->setMaxAge(3600);
        $response->setSharedMaxAge(3600);

        return $response;
    }
}
