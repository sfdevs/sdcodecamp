<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Speaker;
use Cocur\Slugify\Slugify;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class SpeakerAdmin
 * @package AppBundle\Admin
 */
class SpeakerAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Speaker')
                ->with('Content')
                    ->add('first_name', 'text')
                    ->add('last_name', 'text')
                    ->add('email', 'email')
                    ->add('bio_markdown', 'textarea')
                    ->add('twitter', 'text', [
                        'required' => false
                    ])
                    ->add('company', 'text', [
                        'required' => false
                    ])
                    ->add('company_url', 'text', [
                        'required' => false
                    ])
                    ->add('personal_site', 'text', [
                        'required' => false
                    ])
                ->end()
            ->end()
            ->tab('Publish Options')
                ->with('Meta')
                    ->add('slug', 'text', [
                        'required' => false
                    ])
                    ->add('visible', 'checkbox', [
                        'required' => false
                    ])
                ->end()
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('visible');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('first_name')
            ->addIdentifier('last_name')
            ->addIdentifier('visible')
        ;
    }

    /**
     * @param Speaker $speaker
     */
    public function prePersist($speaker)
    {
        if ($speaker->getSlug() === null || $speaker->getSlug() === '') {
            $name = $speaker->getFullName();
            $slugifier = new Slugify();
            $slug = $slugifier->slugify($name);
            $speaker->setSlug($slug);
        }
    }
}
