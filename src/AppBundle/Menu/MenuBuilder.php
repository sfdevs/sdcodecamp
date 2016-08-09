<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\Matcher\Voter\RouteVoter;
use Symfony\Component\HttpFoundation\RequestStack;


/**
 * Class MenuBuilder
 * @package AppBundle\Menu
 */
class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param RequestStack $requestStack
     * 
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack)
    {
        $currentRequest = $requestStack->getCurrentRequest();
        $menu = $this->factory->createItem('root')->setChildrenAttributes(array('class' => 'main', 'id' => 'main_nav'));

        //        $menu->addChild('Home', array('route' => 'homepage'));
        $menu->addChild('Speakers', array('route' => 'speaker_index'));
        $menu->addChild('Sessions', array('route' => 'session_index'));
        $menu->addChild('Sponsors', array('route' => 'page_sponsors'));
//        $menu->addChild('Schedule', array('route'=> 'page_schedule'));
        $menu->addChild('Venue', array('route' => 'page_venue'));

        $RouteVoter = new RouteVoter();
        $RouteVoter->setRequest($currentRequest);

        foreach ($menu->getChildren() as $menuItem) {
            if ($this->isAncestor($currentRequest->getUri(), $menuItem->getUri())) {
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
