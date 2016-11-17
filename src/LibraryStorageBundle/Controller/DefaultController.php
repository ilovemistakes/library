<?php

namespace LibraryStorageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="librarystorage_homepage")
     */
    public function indexAction()
    {
        return $this->render('LibraryStorageBundle:Default:index.html.twig');
    }
}
