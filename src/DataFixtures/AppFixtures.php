<?php

namespace App\DataFixtures;

use App\Entity\CategoryMovie;
use App\Entity\Nationality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpClient\HttpClient;

class AppFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {

        $datas=$this->listerCat();
        foreach ($datas['genres'] as $cat)
        {
            $category=new CategoryMovie();
            $category->setName($cat['name']);
            $manager->persist($category);
            $manager->flush();
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['grpCa', 'grpAll'];
    }
    public function listerCat()
    {
        $client = HttpClient::create();
        $response = $client->request("GET", "https://api.themoviedb.org/3/genre/movie/list?api_key=80eb25b17a7ff4a9f39b04b08692b026&language=fr");
        $response = $response->toArray();
        return $response;
    }



}
