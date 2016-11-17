<?php

namespace StorageApiClientBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Book
 *
 * @JMS\ExclusionPolicy("all")
 */
class Book
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     * @JMS\Expose
     * @JMS\Groups({"Default", "record"})
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
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\Expose
     */
    private $author;

    /**
     * @JMS\Type("StorageApiClientBundle\Entity\Library")
     * @JMS\Expose
     */
    private $library;

    /**
     * @JMS\Type("StorageApiClientBundle\Entity\User")
     * @JMS\Expose
     */
    private $user;

    /**
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
     * @param \StorageApiBundleStorage\Entity\Library $library
     *
     * @return Book
     */
    public function setLibrary(\StorageApiBundleStorage\Entity\Library $library = null)
    {
        $this->library = $library;

        return $this;
    }

    /**
     * Get library
     *
     * @return \StorageApiBundleStorage\Entity\Library
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * Set user
     *
     * @param \StorageApiBundleStorage\Entity\User $user
     *
     * @return Book
     */
    public function setUser(\StorageApiBundleStorage\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \StorageApiBundleStorage\Entity\User
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
        //$this->records = new \Doctrine\Common\Collections\ArrayCollection();
        $this->records = [];
    }

    /**
     * Add record
     *
     * @param \StorageApiBundleStorage\Entity\Record $record
     *
     * @return Book
     */
    public function addRecord(\StorageApiBundleStorage\Entity\Record $record)
    {
        $this->records[] = $record;

        return $this;
    }

    /**
     * Remove record
     *
     * @param \StorageApiBundleStorage\Entity\Record $record
     */
    public function removeRecord(\StorageApiBundleStorage\Entity\Record $record)
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
