<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Speaker;
use Cocur\Slugify\Slugify;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
                    ->add('first_name', TextType::class)
                    ->add('last_name', TextType::class)
                    ->add('email', EmailType::class)
                    ->add('bio_markdown', TextareaType::class)
                    ->add('twitter', TextType::class, [
                        'required' => false
                    ])
                    ->add('company', TextType::class, [
                        'required' => false
                    ])
                    ->add('company_url', TextType::class, [
                        'required' => false
                    ])
                    ->add('personal_site', TextType::class, [
                        'required' => false
                    ])
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
