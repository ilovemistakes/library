<?php

namespace LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use StorageApiClientBundle\Entity\Record;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="library_homepage")
     */
    public function indexAction()
    {
        $books = $this->get('storage_api_client.client')->getBooks();

        dump($books);

        return $this->render('LibraryBundle:Default:index.html.twig', array(
            'books' => $books,
        ));
    }

    /**
     * @Route("/book/{id}/take", name="library_book_take")
     */
    public function takeBookAction(Request $request) {
        $book = $this->get('storage_api_client.client')->getBook($request->get('id'));
        $users = $this->get('storage_api_client.client')->getUsers();

        $record = new Record();
        $record->setAction("take");
        $record->setBook($book);

        $form = $this->createFormBuilder($record)
            ->add('created', DateTimeType::class, array('label' => 'Дата/время'))
            ->add('user', ChoiceType::class, array(
                'choices' => $users,
                'choice_label' => function($user, $key, $index) {
                    return $user->getName();
                },
                'label' => 'Читатель',
            ))
            ->add('save', SubmitType::class, array('label' => 'Взять'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try{
                $res = $this->get('storage_api_client.client')->newRecord($record);

                $this->addFlash(
                    'notice',
                    'Запись о книге успешно создана'
                );
            } catch(\Exception $e) {
                $this->addFlash(
                    'error',
                    'Ошибка создания записи о книге: ' . $e->getMessage()
                );
            }

            return $this->redirectToRoute('library_homepage');
        }

        return $this->render('LibraryBundle:Default:takeBook.html.twig', array(
            'book' => $book,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/book/{id}/return", name="library_book_return")
     */
    public function returnBookAction(Request $request) {
        $book = $this->get('storage_api_client.client')->getBook($request->get('id'));

        $record = new Record();
        $record->setAction("return");
        $record->setBook($book);
        $record->setUser($book->getUser());

        $form = $this->createFormBuilder($record)
            ->add('created', DateTimeType::class, array('label' => 'Дата/время'))
            ->add('save', SubmitType::class, array('label' => 'Вернуть'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try{
                $res = $this->get('storage_api_client.client')->newRecord($record);

                $this->addFlash(
                    'notice',
                    'Запись о книге успешно создана'
                );
            } catch(\Exception $e) {
                $this->addFlash(
                    'error',
                    'Ошибка создания записи о книге: ' . $e->getMessage()
                );
            }

            return $this->redirectToRoute('library_homepage');
        }

        return $this->render('LibraryBundle:Default:returnBook.html.twig', array(
            'book' => $book,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/report", name="library_report")
     */
    public function reportAction(Request $request) {
        $stats = $this->get('storage_api_client.client')->getReportTopBooks(3);

        return $this->render('LibraryBundle:Default:report.html.twig', array(
            'stats' => $stats,
        ));
    }
}
