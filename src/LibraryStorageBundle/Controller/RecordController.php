<?php

namespace LibraryStorageBundle\Controller;

use LibraryStorageBundle\Entity\Record;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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
     * Creates a new record entity.
     *
     * @Route("/new", name="record_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $record = new Record();
        dump($record);
        dump($this->createForm('LibraryStorageBundle\Form\RecordType'));
        $form = $this->createForm('LibraryStorageBundle\Form\RecordType', $record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($record);
            $em->flush($record);

            return $this->redirectToRoute('record_show', array('id' => $record->getId()));
        }

        return $this->render('record/new.html.twig', array(
            'record' => $record,
            'form' => $form->createView(),
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
        $deleteForm = $this->createDeleteForm($record);

        return $this->render('record/show.html.twig', array(
            'record' => $record,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing record entity.
     *
     * @Route("/{id}/edit", name="record_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Record $record)
    {
        $deleteForm = $this->createDeleteForm($record);
        $editForm = $this->createForm('LibraryStorageBundle\Form\RecordType', $record);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('record_edit', array('id' => $record->getId()));
        }

        return $this->render('record/edit.html.twig', array(
            'record' => $record,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a record entity.
     *
     * @Route("/{id}", name="record_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Record $record)
    {
        $form = $this->createDeleteForm($record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($record);
            $em->flush($record);
        }

        return $this->redirectToRoute('record_index');
    }

    /**
     * Creates a form to delete a record entity.
     *
     * @param Record $record The record entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Record $record)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('record_delete', array('id' => $record->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
