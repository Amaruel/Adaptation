<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route("/serie", name="serie_list")
     */
    public function list(SerieRepository $serieRepo)
    {
        $series = $serieRepo->findBy([]);

        return $this->render('serie/list.html.twig', [
            "series" => $series
        ]);

    }

    /**
     * @Route("/serie/{id}", name="serie_details", requirements={"id": "\d+"})
     */
    public function serieDetail($id, Request $request, SerieRepository $repo)
    {
        $serie= $repo->find($id);

        if(empty($serie)){
            throw $this->createNotFoundException("Cette série n'existe pas encore");
        }

        return $this->render("serie/detail.html.twig", [
            "serie" => $serie
        ]);
    }
}
