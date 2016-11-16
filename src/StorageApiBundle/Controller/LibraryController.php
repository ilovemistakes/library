<?php

namespace StorageApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use LibraryStorageBundle\Entity\Library;

/**
 * Library controller.
 *
 * @Route("library")
 */
class LibraryController extends ApiController
{
    /**
     * Lists all library entities.
     *
     * @Route("/", name="api_library_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $libraries = $em->getRepository('LibraryStorageBundle:Library')->findAll();

        return new JsonResponse($this->serialize($libraries, 'list'), 200, array(), true);
    }

    /**
     * Finds and displays a library entity.
     *
     * @Route("/{id}", name="api_library_show")
     * @Method("GET")
     */
    public function showAction(Library $library)
    {
        return new JsonResponse($this->serialize($library, 'details'), 200, array(), true);
    }

    /**
     * Lists all library's book entities.
     *
     * @Route("/{id}/books", name="api_library_book_index")
     * @Method("GET")
     */
    public function indexBooksAction(Library $library) {
        return new JsonResponse($this->serialize($library->getBooks(), 'list'), 200, array(), true);
    }
}
