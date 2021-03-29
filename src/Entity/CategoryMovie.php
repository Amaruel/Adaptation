<?php

namespace App\Entity;

use App\Repository\BookCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookCategoryRepository::class)
 */
class CategoryMovie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Movie", mappedBy="category")
     */
    private $movies;

    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Serie", mappedBy="category")
     */
    private $series;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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



}
