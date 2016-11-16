<?php

namespace LibraryStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="LibraryStorageBundle\Repository\BookRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     * @JMS\Groups({"details", "list"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @JMS\Expose
     * @JMS\Groups({"details", "list"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @JMS\Expose
     * @JMS\Groups({"details", "list"})
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Library", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\Expose
     * @JMS\Groups({"details"})
     */
    private $library;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="books")
     * @JMS\Expose
     * @JMS\Groups({"details"})
     * @JMS\MaxDepth(1)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Record", mappedBy="book")
     */
    private $records;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set library
     *
     * @param \LibraryStorageBundle\Entity\Library $library
     *
     * @return Book
     */
    public function setLibrary(\LibraryStorageBundle\Entity\Library $library = null)
    {
        $this->library = $library;

        return $this;
    }

    /**
     * Get library
     *
     * @return \LibraryStorageBundle\Entity\Library
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * Set user
     *
     * @param \LibraryStorageBundle\Entity\User $user
     *
     * @return Book
     */
    public function setUser(\LibraryStorageBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \LibraryStorageBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString() {
        return $this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->records = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add record
     *
     * @param \LibraryStorageBundle\Entity\Record $record
     *
     * @return Book
     */
    public function addRecord(\LibraryStorageBundle\Entity\Record $record)
    {
        $this->records[] = $record;

        return $this;
    }

    /**
     * Remove record
     *
     * @param \LibraryStorageBundle\Entity\Record $record
     */
    public function removeRecord(\LibraryStorageBundle\Entity\Record $record)
    {
        $this->records->removeElement($record);
    }

    /**
     * Get records
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecords()
    {
        return $this->records;
    }
}
