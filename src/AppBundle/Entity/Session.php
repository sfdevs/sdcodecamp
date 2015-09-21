<?php

namespace AppBundle\Entity;

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
     * @var Speaker
     *
     * @ORM\ManyToOne(targetEntity="Speaker", inversedBy="sessions")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     */
    private $speaker;


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
     * Set speaker
     *
     * @param Speaker $speaker
     * @return Session
     */
    public function setSpeaker(Speaker $speaker = null)
    {
        $this->speaker = $speaker;

        return $this;
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
     * @return Speaker
     */
    public function getSpeaker()
    {
        return $this->speaker;
    }

    public function __toString()
    {
        return $this->title;
    }

}
