<?php

namespace StorageApiClientBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Library
 *
 * @JMS\ExclusionPolicy("all")
 */
class Library
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\Expose
     */
    private $name;

    /**
     * @JMS\Type("array<StorageApiClientBundle\Entity\Book>")
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
     * @param \StorageApiClientBundle\Entity\Book $book
     *
     * @return Library
     */
    public function addBook(\StorageApiClientBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \StorageApiClientBundle\Entity\Book $book
     */
    public function removeBook(\StorageApiClientBundle\Entity\Book $book)
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
