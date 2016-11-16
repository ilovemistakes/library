<?php

namespace StorageApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/{id}", name="api_user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        return new JsonResponse($this->serialize($user, 'details'), 200, array(), true);
    }
}
