<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\RegexVoter;
use Knp\Menu\Matcher\Voter\RouteVoter;
use Knp\Menu\Matcher\Voter\UriVoter;
use Symfony\Component\HttpFoundation\RequestStack;


class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $currentRequest = $requestStack->getCurrentRequest();
        $menu = $this->factory->createItem('root')->setChildrenAttributes(array('class'=>'main', 'id'=>'main_nav'));

        //        $menu->addChild('Home', array('route' => 'homepage'));
        $menu->addChild('Speakers', array('route'=> 'speaker_index'));
        $menu->addChild('Sessions', array('route'=> 'session_index'));
        $menu->addChild('Venue', array('route'=> 'page_venue'));
        $menu->addChild('Sponsors', array('route'=> 'page_sponsors'));

        $RouteVoter = new RouteVoter();
        $RouteVoter->setRequest($currentRequest);

        foreach ($menu->getChildren() as $menuItem)
        {
            if ($this->isAncestor($currentRequest->getUri(), $menuItem->getUri()))
            {
                $menuItem->setCurrent(true);
            }

        }

        return $menu;
    }

    /**
     * @param $currentUrl
     * @param $menuUrl
     *
     * @return string
     */
    private function isAncestor($currentUrl, $menuUrl)
    {
        return strstr($currentUrl, $menuUrl);
    }
} 