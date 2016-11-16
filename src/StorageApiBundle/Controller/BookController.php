<?php

namespace StorageApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use LibraryStorageBundle\Entity\Book;

/**
 * Book controller.
 *
 * @Route("book")
 */
class BookController extends ApiController
{
    /**
     * Lists all book entities.
     *
     * @Route("/", name="api_book_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('LibraryStorageBundle:Book')->findAll();

        return new JsonResponse($this->serialize($books, 'list'), 200, array(), true);
    }

    /**
     * Finds and displays a book entity.
     *
     * @Route("/{id}", name="api_book_show")
     * @Method("GET")
     */
    public function showAction(Book $book)
    {
        return new JsonResponse($this->serialize($book, 'details'), 200, array(), true);
    }
}
