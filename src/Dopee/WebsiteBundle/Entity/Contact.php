<?php
namespace Dopee\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Dit veld is verplicht")
     * @Assert\Length(min=2)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Dit veld is verplicht")
     * @Assert\Email(message="Ongeldig e-mailadres")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Dit veld is verplicht")
     * @Assert\Length(min=3)
     */
    protected $subject;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Dit veld is verplicht")
     * @Assert\Length(min=5)
     */
    protected $message;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $ip;

    /**
     * @ORM\Column(type="datetime", name="posted_at")
     */
    protected $postedAt;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getPostedAt()
    {
        return $this->postedAt;
    }

    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;
    }
}
