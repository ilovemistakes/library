<?php

namespace LibraryStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Record
 *
 * @ORM\Table(name="record")
 * @ORM\Entity(repositoryClass="LibraryStorageBundle\Repository\RecordRepository")
 */
class Record
{
    const ACTION_TAKE = "take";
    const ACTION_RETURN = "return";

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
     * @ORM\Column(name="action", type="string", length=255)
     */
    private $action;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="records")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="records")
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
     * @param \LibraryStorageBundle\Entity\User $user
     *
     * @return Record
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
