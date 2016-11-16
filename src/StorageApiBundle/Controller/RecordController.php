<?php

namespace StorageApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use LibraryStorageBundle\Entity\Record;
use LibraryStorageBundle\Exception\BookStatusException;
use StorageApiBundle\Exception\ApiException;

/**
 * Record controller.
 *
 * @Route("record")
 */
class RecordController extends ApiController
{
    /**
     * Lists all record entities.
     *
     * @Route("/", name="api_record_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $records = $em->getRepository('LibraryStorageBundle:Record')->findAll();

        return new JsonResponse($this->serialize($records, 'list'), 200, array(), true);
    }

    /**
     * Finds and displays a record entity.
     *
     * @Route("/{id}", name="api_record_show")
     * @Method("GET")
     */
    public function showAction(Record $record)
    {
        return new JsonResponse($this->serialize($record, 'details'), 200, array(), true);
    }

    /**
     * Creates new record
     *
     * @Route("/", name="api_record_new")
     * @Method("POST")
     */
    public function newAction(Request $request) {
        try {
            $record = $this->unserialize($request->getContent(), 'LibraryStorageBundle\Entity\Record');
            // TODO: handle exceptions carefully
        } catch(\Exception $e) {
            throw new ApiException(400, $e->getMessage());
        }

        $errors = $this->get('validator')->validate($record);

        if(count($errors) > 0) {
            throw new ApiException(400, (string)$errors);
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($record);
            $em->flush($record);
        } catch(BookStatusException $e) {
            throw new ApiException(400, $e->getMessage(), $e);
        }

        return $this->redirectToRoute(
            'api_record_show',
            array('id' => $record->getId()),
            204
        )->setContent('');
    }
}
