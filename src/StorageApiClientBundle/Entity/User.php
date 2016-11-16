<?php

namespace StorageApiClientBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * User
 *
 * @JMS\ExclusionPolicy("all")
 */
class User
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
     */
    private $name;

    /**
     * @JMS\Type("array<StorageApiClientBundle\Entity\Book>")
     */
    private $books;

    /**
     * @JMS\Type("array<StorageApiClientBundle\Entity\Record>")
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
     * @param \StorageApiClientBundle\Entity\Book $book
     *
     * @return User
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

    /**
     * Add record
     *
     * @param \StorageApiClientBundle\Entity\Record $record
     *
     * @return User
     */
    public function addRecord(\StorageApiClientBundle\Entity\Record $record)
    {
        $this->records[] = $record;

        return $this;
    }

    /**
     * Remove record
     *
     * @param \StorageApiClientBundle\Entity\Record $record
     */
    public function removeRecord(\StorageApiClientBundle\Entity\Record $record)
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
