<?php

namespace LibraryStorageBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use LibraryStorageBundle\Entity\Book;
use LibraryStorageBundle\Entity\Record;
use LibraryStorageBundle\Exception\BookStatusException;

class RecordSubscriber implements EventSubscriber {
    public function onFlush(OnFlushEventArgs $args) {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach($uow->getScheduledEntityInsertions() as $entity) {
            if(!$entity instanceof Record) {
                continue;
            }

            $book = $entity->getBook();

            // TODO: check status according to previous action
            if($entity->getAction() == Record::ACTION_TAKE) {
                if(!is_null($book->getUser())) {
                    throw new BookStatusException("Book is already taken");
                }

                $book->setUser($entity->getUser());
            } else if($entity->getAction() == Record::ACTION_RETURN) {
                if(is_null($book->getUser()) || $book->getUser()->getId() != $entity->getUser()->getId()) {
                    throw new BookStatusException("Book is already returned");
                }

                $book->setUser(null);
            }

            $em->persist($book);
        }

        $uow->computeChangeSets();
    }

    public function getSubscribedEvents()
    {
        return array(Events::onFlush);
    }
}

