<?php

namespace StorageApiClientBundle\Entity;

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
     * @JMS\Type("integer")
     * @JMS\Expose
     */
    private $count;

    /**
     * @JMS\Type("StorageApiClientBundle\Entity\Book")
     * @JMS\Expose
     */
    private $book;


    /**
     * Set count
     *
     * @param string $count
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
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set book
     *
     * @param \StorageApiClientBundle\Entity\Book $book
     *
     * @return Record
     */
    public function setBook(\StorageApiClientBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \StorageApiClientBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

}
