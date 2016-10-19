<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\Matcher\Voter\RouteVoter;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class MenuBuilder.
 *
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
        $menu = $this->factory->createItem('root')->setChildrenAttributes([
            'class' => 'main',
            'id' => 'main_nav',
        ]);

        $menu->addChild('Speakers', array('route' => 'speaker_index'));

        $menu->addChild('Schedule', array('uri' => '#', 'class' => 'has-child-munu'));
        $menu['Schedule']->addChild('View Sessions', array('route' => 'session_index'));
        $menu['Schedule']->addChild('Family Sessions', array('route' => 'page_family'));
        $menu['Schedule']->setAttributes([
            'class' => 'has-child-menu'
        ]);
//        $menu['Schedule']->addChild('Complete Schedule', array('route'=> 'page_schedule'));

        $menu->addChild('Sponsors', array('route' => 'page_sponsors'));

        $menu->addChild('Information', array('uri' => '#'));
        $menu['Information']->addChild('About Us', array('route' => 'page_about_us'));
        $menu['Information']->addChild('Code of Conduct', array('route' => 'page_code_of_conduct'));
        $menu['Information']->addChild('Venue', array('route' => 'page_venue'));
        $menu['Information']->addChild('OpenSpace', array('route' => 'page_open_space'));
        $menu['Information']->setAttributes([
            'class' => 'has-child-menu'
        ]);


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
