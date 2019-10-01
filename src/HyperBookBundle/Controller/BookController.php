<?php

namespace HyperBookBundle\Controller;


use HyperBookBundle\Entity\Book;
use HyperBookBundle\Entity\Category;
use HyperBookBundle\Form\Type\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/books", name="book")
 */
class BookController extends Controller
{
    /**
     * @Route("/", name="book_home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('HyperBookBundle:Category')->findBy([],['id'=>'ASC']);
        $book = $em->getRepository('HyperBookBundle:Book')->findBy([],['category'=>'DESC']);

        //return $this->render('HyperBookBundle:Book:index.html.twig', ["books" => $book, "categories" => $category]);
        return $this->render('HyperBookBundle:Book:index.html.twig', ["books" => $book, "categories" => $category]);
    }

    /**
     * @Route("/download/{bookId}", name="book_download")
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