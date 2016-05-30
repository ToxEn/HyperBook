<?php

namespace HyperBookBundle\Controller;

use HyperBookBundle\Entity\Book;
use HyperBookBundle\Entity\Category;
use HyperBookBundle\Form\Type\BookType;
use HyperBookBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin", name="admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('HyperBookBundle:Category')->findBy([],['id'=>'ASC']);
        $book = $em->getRepository('HyperBookBundle:Book')->findBy([],['category'=>'ASC']);

        return $this->render('HyperBookBundle:Admin:index.html.twig', ["books" => $book, "categories" => $category]);
    }

    /**
     * @Route("/books/add", name="admin_book_add")
     */
    public function addBookAction(Request $request)
    {
        $book = new Book();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('HyperBookBundle:Book:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/books/{bookId}/edit", name="admin_book_edit")
     */
    public function editBookAction(Request $request, Book $bookId)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(BookType::class, $bookId);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($bookId);
            $em->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('HyperBookBundle:Book:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/books/{bookId}/delete", name="admin_book_delete")
     */
    public function deleteBookAction(Book $bookId)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($bookId);
        $em->flush();

        return $this->redirectToRoute('admin_home');
    }

    /**
     * @Route("/categories/add", name="admin_category_add")
     */
    public function addCatAction(Request $request)
    {
        $category = new Category();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('HyperBookBundle:Category:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/categories/{categoryId}/edit", name="admin_category_edit")
     */
    public function editCatAction(Request $request, Category $categoryId)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(BookType::class, $categoryId);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($categoryId);
            $em->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('HyperBookBundle:Category:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/categories/{categoryId}/delete", name="admin_category_delete")
     */
    public function updateAction(Category $categoryId)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($categoryId);
        $em->flush();

        return $this->redirectToRoute('admin_home');
    }
}
