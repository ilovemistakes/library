<?php

namespace StorageApiClientBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Record
 *
 * @JMS\ExclusionPolicy("all")
 */
class Record
{
    const ACTION_TAKE = "take";
    const ACTION_RETURN = "return";

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
    private $action;

    /**
     * @var datetime
     *
     * @JMS\Type("DateTime")
     * @JMS\Expose
     */
    private $created;

    /**
     * @JMS\Type("StorageApiClientBundle\Entity\User")
     * @JMS\Expose
     */
    private $user;

    /**
     * @JMS\Type("StorageApiClientBundle\Entity\Book")
     * @JMS\Expose
     */
    private $book;


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
     * Set action
     *
     * @param string $action
     *
     * @return Record
     */
    public function setAction($action)
    {
        if(!in_array($action, array(self::ACTION_TAKE, self::ACTION_RETURN))) {
            throw new \InvalidArgumentException("Invalid action");
        }

        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set user
     *
     * @param \StorageApiClientBundle\Entity\User $user
     *
     * @return Record
     */
    public function setUser(\StorageApiClientBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \StorageApiClientBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
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

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Record
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    public function __construct() {
        $this->created = new \DateTime();
    }
}
