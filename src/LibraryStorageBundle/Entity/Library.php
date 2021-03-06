<?php

namespace LibraryStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Library
 *
 * @ORM\Table(name="library")
 * @ORM\Entity(repositoryClass="LibraryStorageBundle\Repository\LibraryRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Library
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     * @JMS\Groups({"details", "list", "report"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @JMS\Expose
     * @JMS\Groups({"details", "list", "report"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Book", mappedBy="library")
     */
    private $books;


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
     * @return Library
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
     * @return Library
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
}
