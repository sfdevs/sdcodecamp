<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Michelf\Markdown;

/**
 * Session
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SessionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Session
{
    use TimeStampedEntity;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract_markdown", type="text", nullable=true)
     */
    private $abstractMarkdown;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Speaker", mappedBy="sessions")
     */
    private $speakers;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->speakers = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Session
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set abstractMarkdown
     *
     * @param string $abstractMarkdown
     * @return Session
     */
    public function setAbstractMarkdown($abstractMarkdown)
    {
        $this->abstractMarkdown = $abstractMarkdown;

        return $this;
    }

    /**
     * Get abstractMarkdown
     *
     * @return string
     */
    public function getAbstractMarkdown()
    {
        return $this->abstractMarkdown;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Session
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @return boolean
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * @param boolean $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Add speaker
     *
     * @param Speaker $speaker
     * @return Session
     */
    public function addSpeaker(Speaker $speaker = null)
    {
        $this->speakers[] = $speaker;

        return $this;
    }

    /**
     * @param Speaker $speaker
     */
    public function removeSpeaker(Speaker $speaker)
    {
        $this->speakers->removeElement($speaker);
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistFunctions()
    {
        $this->abstractMarkdown = Markdown::defaultTransform($this->abstract);
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdateFunctions()
    {
        $this->abstractMarkdown = Markdown::defaultTransform($this->abstract);
    }

    /**
     * Get speaker
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

}
