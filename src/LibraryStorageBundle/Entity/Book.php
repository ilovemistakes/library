<?php

namespace LibraryStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="LibraryStorageBundle\Repository\BookRepository")
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Library", inversedBy="books")
     */
    private $library;

    /**
     * @ORM\ManyToOne(targetEntity="library", inversedBy="books")
     */
    private $user;


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
     * @param \LibraryStorageBundle\Entity\library $user
     *
     * @return Book
     */
    public function setUser(\LibraryStorageBundle\Entity\library $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \LibraryStorageBundle\Entity\library
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString() {
        return $this->getName();
    }
}
