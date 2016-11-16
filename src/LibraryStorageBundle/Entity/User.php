<?php

namespace LibraryStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="LibraryStorageBundle\Repository\UserRepository")
 * @JMS\ExclusionPolicy("all")
 */
class User
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
     * @ORM\OneToMany(targetEntity="Book", mappedBy="user")
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity="Record", mappedBy="user")
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
     * @return User
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
     * Constructor
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add book
     *
     * @param \LibraryStorageBundle\Entity\Book $book
     *
     * @return User
     */
    public function addBook(\LibraryStorageBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \LibraryStorageBundle\Entity\Book $book
     */
    public function removeBook(\LibraryStorageBundle\Entity\Book $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Add record
     *
     * @param \LibraryStorageBundle\Entity\Record $record
     *
     * @return User
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
