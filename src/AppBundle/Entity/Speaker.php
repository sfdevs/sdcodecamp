<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Michelf\Markdown;

/**
 * Speaker
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpeakerRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Speaker
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

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
     * @var string
     *
     * @ORM\Column(name="bio", type="text", nullable=true)
     */
    private $bio;

    /**
     * @var string
     *
     * @ORM\Column(name="bio_markdown", type="text", nullable=true)
     */
    private $bioMarkdown;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="company_url", type="string", length=255, nullable=true)
     */
    private $companyUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_site", type="string", length=255, nullable=true)
     */
    private $personalSite;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Session", inversedBy="speakers")
     * @ORM\JoinTable(name="speaker_sessions")
     */
    private $sessions;


    public function __construct()
    {
        $this->sessions = new ArrayCollection();
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
     * Set firstName
     *
     * @param string $firstName
     * @return Speaker
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Speaker
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Speaker
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Speaker
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Speaker
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set bio
     *
     * @param string $bio
     * @return Speaker
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @return string
     */
    public function getBioMarkdown()
    {
        return $this->bioMarkdown;
    }

    /**
     * @param string $bioMarkdown
     */
    public function setBioMarkdown($bioMarkdown)
    {
        $this->bioMarkdown = $bioMarkdown;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Speaker
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Speaker
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set companyUrl
     *
     * @param string $companyUrl
     * @return Speaker
     */
    public function setCompanyUrl($companyUrl)
    {
        $this->companyUrl = $companyUrl;

        return $this;
    }

    /**
     * Get companyUrl
     *
     * @return string
     */
    public function getCompanyUrl()
    {
        return $this->companyUrl;
    }

    /**
     * Set personalSite
     *
     * @param string $personalSite
     * @return Speaker
     */
    public function setPersonalSite($personalSite)
    {
        $this->personalSite = $personalSite;

        return $this;
    }

    /**
     * Get personalSite
     *
     * @return string
     */
    public function getPersonalSite()
    {
        return $this->personalSite;
    }

    /**
     * Add sessions
     *
     * @param Session $sessions
     * @return Speaker
     */
    public function addSession(Session $sessions)
    {
        $this->sessions[] = $sessions;

        return $this;
    }

    /**
     * Remove sessions
     *
     * @param Session $session
     */
    public function removeSession(Session $session)
    {
        $this->sessions->removeElement($session);
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistFunctions()
    {
        $this->bioMarkdown = Markdown::defaultTransform($this->bio);
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdateFunctions()
    {
        $this->bioMarkdown = Markdown::defaultTransform($this->bio);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    public function getFullName()
    {
        return sprintf("%s %s", $this->firstName, $this->lastName);
    }

    public function getEmailMd5()
    {
        return md5(trim($this->email));
    }

    public function __toString()
    {
        return $this->getFullName();
    }
}
