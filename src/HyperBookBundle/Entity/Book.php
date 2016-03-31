<?php

namespace HyperBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="HyperBookBundle\Repository\BookRepository")
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=255)
     */
    private $pdf;

    /**
     * @var string
     *
     * @ORM\Column(name="total_dl", type="string", length=255)
     */
    private $totalDl;

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="HyperBookBundle\Entity\Category")
     */
    private $category;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     * @return Book
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string 
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set totalDl
     *
     * @param string $totalDl
     * @return Book
     */
    public function setTotalDl($totalDl)
    {
        $this->totalDl = $totalDl;

        return $this;
    }

    /**
     * Get totalDl
     *
     * @return string 
     */
    public function getTotalDl()
    {
        return $this->totalDl;
    }

    /**
     * Set category
     *
     * @param \MimFrontBundle\Entity\Category $category
     * @return Book
     */
    public function setCategory(\MimFrontBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \MimFrontBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
