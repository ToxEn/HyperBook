<?php

namespace HyperBookBundle\Controller;

use HyperBookBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bookLast = $em->getRepository('HyperBookBundle:Book')->findBy([],['id'=>'DESC'],5);
        $bookTop = $em->getRepository('HyperBookBundle:Book')->findBy([],['totalDl'=>'DESC'],5);

        return $this->render('HyperBookBundle:Default:index.html.twig', ["booksLast" => $bookLast, "booksTop" => $bookTop]);
    }

    /**
     * @Route("/download/{bookId}", name="home_download")
     */
    public function downloadHomeAction(Book $bookId)
    {
        $em = $this->getDoctrine()->getManager();

        $bookId->setTotalDl($bookId->getTotalDl());
        $em->persist($bookId);
        $em->flush();

        $file = $bookId->getImageName();
        $path = $this->get('kernel')->getRootDir() . '/../web/images/books/';

        header ("Content-type: application/force-download");
        header ("Content-disposition: filename=$file");

        readFile($path.$file);

        return $this->redirectToRoute('home');
    }
}
