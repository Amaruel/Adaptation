<?php
namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route ("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render("default/accueil.html.twig");
    }

    /**
     * @Route ("/aboutus", name="about_us")
     */
    public function aboutus()
    {
        return $this->render("default/aboutus.html.twig");
    }
}