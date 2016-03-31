<?php

namespace HyperBookBundle\Controller;

use HyperBookBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/category", name="category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="cat_home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('HyperBookBundle:Category')->findAll();

        return $this->render('HyperBookBundle:Category:index.html.twig', ["categories" => $category]);
    }
}