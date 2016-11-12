<?php

namespace LibraryStorageBundle\Controller;

use LibraryStorageBundle\Entity\Record;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Record controller.
 *
 * @Route("record")
 */
class RecordController extends Controller
{
    /**
     * Lists all record entities.
     *
     * @Route("/", name="record_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $records = $em->getRepository('LibraryStorageBundle:Record')->findAll();

        return $this->render('record/index.html.twig', array(
            'records' => $records,
        ));
    }

    /**
     * Finds and displays a record entity.
     *
     * @Route("/{id}", name="record_show")
     * @Method("GET")
     */
    public function showAction(Record $record)
    {

        return $this->render('record/show.html.twig', array(
            'record' => $record,
        ));
    }
}
