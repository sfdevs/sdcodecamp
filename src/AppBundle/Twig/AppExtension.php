<?php

namespace AppBundle\Twig;

use AppBundle\Summary\Summarizer;

/**
 * Class AppExtension.
 *
 * @package AppBundle\Twig
 */
class AppExtension extends \Twig_Extension
{
    /**
     * @var Summarizer
     */
    private $summarizer;

    /**
     * AppExtension constructor.
     *
     * @param Summarizer $summarizer
     */
    public function __construct(
        Summarizer $summarizer
    ) {
        $this->summarizer = $summarizer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'summarize', [$this->summarizer, 'summarize']
            ),
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_extension';
    }
}
