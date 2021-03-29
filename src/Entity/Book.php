<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Date;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 * @Vich\Uploadable()
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $ISBN;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pagination;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $abstract;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bookcover;

    /**
     * @Vich\UploadableField(mapping="book_images", fileNameProperty="bookcover")
     * @var File
     */
    private $bookcoverfile;

    /**
     * @ORM\Column (type="datetime")
     */
    private $datecreated;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class)
     * @ORM\JoinTable(name="Authors_book")
     */
    private $authors;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="books")
     * @ORM\JoinTable(name="Categories_book")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Publisher", inversedBy="books")
     */
    private $publisher;

    /**
     * @ORM\ManyToMany(targetEntity=Movie::class, inversedBy="books")
     * @ORM\JoinTable(name="Movies_books")
     */
    private $movies;

    /**
     * @ORM\ManyToMany(targetEntity=Serie::class)
     * @ORM\JoinTable(name="Series_books")
     */
    private $series;

    //propriété de type ArrayCollection (un objet)
    public function __construct() {
        $this ->categories = new ArrayCollection();
        $this ->authors = new ArrayCollection();
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getISBN(): ?int
    {
        return $this->ISBN;
    }

    public function setISBN(int $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getPagination(): ?int
    {
        return $this->pagination;
    }

    public function setPagination(?int $pagination): self
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBookcover()
    {
        return $this->bookcover;
    }

    /**
     * @param mixed $bookcover
     */
    public function setBookcover($bookcover): void
    {
        $this->bookcover = $bookcover;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->datecreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($datecreated): void
    {
        $this->datecreated = $datecreated;
    }

    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param mixed $authors
     */
    public function setAuthors($authors): void
    {
        $this->authors = $authors;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher($publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * @return mixed
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * @param mixed $movies
     */
    public function setMovies($movies): void
    {
        $this->movies = $movies;
    }

    /**
     * @return mixed
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param mixed $series
     */
    public function setSeries($series): void
    {
        $this->series = $series;
    }

    /**
     * @return File
     */
    public function getBookcoverfile()
    {
        return $this->bookcoverfile;
    }

    /**
     * @param File $bookcoverfile
     */
    public function setBookcoverfile(File $bookcover = null): void
    {
        $this->bookcoverfile=$bookcover;

        if($bookcover) {
            $this->datecreated = new \DateTime('now');
        }

    }

}
