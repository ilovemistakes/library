<?php

namespace LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StorageApiClientBundle\Entity\Record;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $books = $this->get('storage_api_client.client')->getBooks();
        dump($books);

        $book = $this->get('storage_api_client.client')->getBook(2);
        dump($book);

        $user = $this->get('storage_api_client.client')->getUser(2);
        dump($user);

        $users = $this->get('storage_api_client.client')->getUsers();
        dump($users);

        $record = new Record();
        $record->setAction("take");
        $record->setCreated(new \DateTime());
        $record->setBook($book);
        $record->setUser($user);

        $res = $this->get('storage_api_client.client')->newRecord($record);
        dump($res);

        return $this->render('LibraryBundle:Default:index.html.twig');
    }
}
