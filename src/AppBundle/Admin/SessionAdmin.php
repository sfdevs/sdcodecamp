<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Session;
use Cocur\Slugify\Slugify;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SessionAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Session')
                ->with('Content')
                    ->add('title', TextType::class)
                    ->add('abstract', TextareaType::class)
                ->end()
            ->end()
            ->tab('Publish Options')
                ->with('Meta')
                    ->add('slug', TextType::class, [
                        'required' => false
                    ])
                    ->add('visible', CheckboxType::class, [
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
            ->addIdentifier('title')
            ->addIdentifier('visible');
    }

    /**
     * @param Session $speaker
     */
    public function prePersist($session)
    {
        if ($session->getSlug() === null || $session->getSlug() === '') {
            $name = $session->getTitle();
            $slugifier = new Slugify();
            $slug = $slugifier->slugify($name);
            $session->setSlug($slug);
        }
    }

    /**
     * @param Session $speaker
     */
    public function preUpdate($session)
    {
        if ($session->getSlug() === null || $session->getSlug() === '') {
            $name = $session->getTitle();
            $slugifier = new Slugify();
            $slug = $slugifier->slugify($name);
            $session->setSlug($slug);
        }
    }
}
