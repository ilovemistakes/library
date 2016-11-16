<?php

namespace StorageApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use LibraryStorageBundle\Entity\User;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends ApiController
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="api_user_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('LibraryStorageBundle:User')->findAll();

        return new JsonResponse($this->serialize($users, 'list'), 200, array(), true);
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="api_user_show", requirements={"id": "\d+"})
     * @Route("/{name}", name="api_user_show_by_name")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        return new JsonResponse($this->serialize($user, 'details'), 200, array(), true);
    }

    /**
     * Finds and displays a user's books.
     *
     * @Route("/{id}/report/books", name="api_user_report_books", requirements={"id": "\d+"})
     * @Route("/{name}/report/books", name="api_user_report_books_by_name")
     * @Method("GET")
     */
    public function reportBooksAction(User $user)
    {
        return new JsonResponse($this->serialize($user->getBooks(), 'list'), 200, array(), true);
    }

    /**
     * Finds and displays a user's action records. Example of custom report with parameters.
     *
     * @Route("/{id}/report/records", name="api_user_report_records", requirements={"id": "\d+"})
     * @Route("/{name}/report/records", name="api_user_report_records_by_name")
     * @Method("GET")
     */
    public function reportRecordsAction(User $user, Request $request)
    {
        if($request->get('from') && $request->get('to')) {
            $records = $this->getDoctrine()->getRepository('LibraryStorageBundle:Record')->findByUserAndDateRange(
                $user,
                $request->get('from'),
                $request->get('to')
            );
        } else {
            $records = $user->getRecords();
        }

        return new JsonResponse($this->serialize($records, 'list'), 200, array(), true);
    }
}
