<?php

namespace LibraryStorageBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Book statistics
 *
 * @JMS\ExclusionPolicy("all")
 */
class BookStat
{
     /**
     * @var int
     *
     * @JMS\Expose
     * @JMS\Type("integer")
     * @JMS\Groups({"report"})
     */
    private $count;

    /**
     * @JMS\Expose
     * @JMS\Type("LibraryStorageBundle\Entity\Book")
     * @JMS\Groups({"report"})
     */
    private $book;


    /**
     * Set count
     *
     * @param int $count
     *
     * @return BookStat
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set book
     *
     * @param \LibraryStorageBundle\Entity\Book $book
     *
     * @return Record
     */
    public function setBook(\LibraryStorageBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \LibraryStorageBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

}
