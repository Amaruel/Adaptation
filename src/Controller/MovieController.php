<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="movie_list")
     */
    public function list(MovieRepository $movieRepo)
    {
        $movies = $movieRepo->findBy([]);

        return $this->render('movie/movielist.html.twig', [
            "movies" => $movies
        ]);

    }

    /**
     * @Route("/movie/{id}", name="movie_details", requirements={"id": "\d+"})
     */
    public function movieDetail($id, Request $request, MovieRepository $repo)
    {
        $movie= $repo->find($id);

        if(empty($movie)){
            throw $this->createNotFoundException("Cette série n'existe pas encore");
        }
        else{
            $this->convertToHoursMins($movie->getTime(), '%02d:%02d');
        }

        return $this->render("movie/moviedetail.html.twig", [
            "movie" => $movie
        ]);
    }

    function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }


}
