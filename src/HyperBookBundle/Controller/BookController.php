<?php

namespace HyperBookBundle\Controller;

use HyperBookBundle\Entity\Book;
use HyperBookBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/book", name="book")
 */
class BookController extends Controller
{
    /**
     * @Route("/", name="book_home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $book = $em->getRepository('HyperBookBundle:Book')->findAll();

        return $this->render('HyperBookBundle:Book:index.html.twig', ["books" => $book]);
    }

    /**
     * @Route("/add", name="book_add")
     */
    public function addAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $book = new Book();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($book)
            ->add('title', 'text', ['attr' => ['class' => 'toto']])
            ->add('author', 'text', ['attr' => ['class' => 'toto']])
            ->add('description', 'text', ['attr' => ['class' => 'toto']])
            ->add('totalDl', 'text', ['attr' => ['class' => 'toto']])
            ->add('category', null, ['attr' => ['class' => 'toto']])
            ->add('imageFile', 'file', ['attr' => ['class' => 'toto']])
            ->add('submit', 'submit', ['attr' => ['class' => 'toto']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('HyperBookBundle:Book:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}