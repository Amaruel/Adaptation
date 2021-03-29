<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Publisher;
use App\Form\BookType;
use App\Form\PublisherType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="booklist")
     */
    public function booklist(BookRepository $bookRepo)
    {
        $books = $bookRepo->findAll();

        return $this->render('book/booklist.html.twig', [
            "books" => $books,
        ]);
    }

    /**
     * @Route("/book/{id}", name="book_details", requirements={"id": "\d+"})
     */
    public function bookDetail($id, Request $request, BookRepository $repo)
    {
        $book= $repo->find($id);

        if(empty($book)){
            throw $this->createNotFoundException("Ce livre n'existe pas encore");
        }

        return $this->render("book/detail.html.twig", [
            "book" => $book
        ]);
    }

    /**
     * @Route("/book/add", name="book_add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        //on créé une entité de livre
        $book = new Book();
        $book -> setDateCreated(new \DateTime());
        //on créé le formulaire
        $bookForm = $this->createForm(BookType::class, $book);


        $publisher = new Publisher();
        $publisher -> setDateCreated(new \DateTime());
        $publisherForm = $this->createForm(PublisherType::class, $publisher);
        $publisherForm->handleRequest($request);
        if($publisherForm->isSubmitted() && $publisherForm->isValid()) {
            $em->persist($publisher);
            $em->flush();
            $this->addFlash('success', 'Votre éditeur a été ajouté');
            //return $this->redirectToRoute('book_add');
        }
        //on récupère les informations du formulaire
        $bookForm->handleRequest($request);

        //si le formulaire est bien soumis alors on rentre les informations en BDD
        if($bookForm->isSubmitted() && $bookForm->isValid()){

            $em->persist($book);
            $em->flush();

            //ajout d'un message flash pour dire à l'utilisateur que sa série a été ajoutée
            $this->addFlash('success', 'Votre livre a bien été ajoutée !');

            //redirection vers la page série_detail de la série créée
            return $this->redirectToRoute('book_details', [
                'id'=>$book->getId(),


            ]);
        }

        return $this->render('book/addbook.html.twig', [
            "bookForm" => $bookForm->createView(),
            "publisherForm" => $publisherForm-> createView()
        ]);

    }



}
