<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Form\SearchType;
use App\Repository\LivreRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookstoreController extends AbstractController
{

    private $objectManager;

    public function __construct(EntityManagerInterface  $objectManager)
    {
        $this->objectManager = $objectManager;
    }


    #[Route('/', name: 'home')]
    public function home(){
        $repo = $this->objectManager->getRepository(Livre::class);

        $books = $repo->findBy([],[],12);

        return $this->render('bookstore/home.html.twig',[
            'controller_name'=>'BookstoreController',
            'books'=> $books
        ]);
    }

    
    
    #[Route('/book/{id}', name: 'bookid')]
    public function bookId(int $id){
        $repo = $this->objectManager->getRepository(Livre::class);

        $book = $repo->find($id);

        return $this->render('bookstore/book.html.twig',[
            'controller_name'=>'BookstoreController',
            'book'=> $book,
            
        ]);
    }


    #[Route('/books', name: 'books')]
    public function Books(Request $request,PaginatorInterface $paginator, LivreRepository $livreRepository){

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class , $search);
        $form->handleRequest($request);
        $form2 = $this->createForm(SearchType::class , $search);
        $form2->handleRequest($request);

        

        if($request->get('keyword')){
            $donnees = $livreRepository->findByTitleField($search->getKeyword());
        }
        else if($request->get('dateFrom') and $request->get('dateFrom')){
            $donnees = $livreRepository->findByDate($search->getDateFrom(), $search->getDateTo());
        }
        else{
            $donnees = $livreRepository->findAll();
        }

        $repo2 = $this->objectManager->getRepository(Genre::class);
        $genres = $repo2->findAll();

        $repo3 = $this->objectManager->getRepository(Auteur::class);
        $auteurs = $repo3->findAll();

        $books = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            10 
        );

        return $this->render('bookstore/books.html.twig',[
            'controller_name'=>'BookstoreController',
            'books'=> $books,
            'genres'=> $genres,
            'auteurs'=> $auteurs,
            'form' =>  $form->createView(),
            'form2' =>  $form2->createView()
        ]);
    }
    

    #[Route('/books/a{id}', name: 'authorsbooks')]
    public function auteursBooks(Request $request,PaginatorInterface $paginator, int $id, LivreRepository $livreRepository){

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class , $search);
        $form->handleRequest($request);
        $form2 = $this->createForm(SearchType::class , $search);
        $form2->handleRequest($request);

        $repo = $this->objectManager->getRepository(Auteur::class);
        $donnee = $repo->find($id);

        if($request->get('keyword')){
            $donnees = $livreRepository->findByTitleField($search->getKeyword());
        }
        else if($request->get('dateFrom') and $request->get('dateFrom')){
            $donnees = $livreRepository->findByDate($search->getDateFrom(), $search->getDateTo());
        }
        else{
            $donnees = $donnee->getLivres();
        }
        

        $repo2 = $this->objectManager->getRepository(Genre::class);
        $genres = $repo2->findAll();

        
        $auteurs = $repo->findAll();

        $books = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1), 
            10 
        );

        return $this->render('bookstore/books.html.twig',[
            'controller_name'=>'BookstoreController',
            'books'=> $books,
            'genres'=> $genres,
            'auteurs'=> $auteurs,
            'form' =>  $form->createView(),
            'form2' =>  $form2->createView()
        ]);
    }

    #[Route('/books/g{id}', name: 'genresbooks')]
    public function genresBooks(Request $request,PaginatorInterface $paginator, int $id, LivreRepository $livreRepository){

       
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class , $search);
        $form->handleRequest($request);
        $form2 = $this->createForm(SearchType::class , $search);
        $form2->handleRequest($request);

        $repo = $this->objectManager->getRepository(Genre::class);
        $donnee = $repo->find($id);

        if($request->get('keyword')){
            $donnees = $livreRepository->findByTitleField($search->getKeyword());
        }
        else if($request->get('dateFrom') and $request->get('dateFrom')){
            $donnees = $livreRepository->findByDate($search->getDateFrom(), $search->getDateTo());
        }
        else{
            $donnees = $donnee->getLivres();
        }


        $genres = $repo->findAll();

        $repo3 = $this->objectManager->getRepository(Auteur::class);
        $auteurs = $repo3->findAll();

        $books = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            10 
        );

        return $this->render('bookstore/books.html.twig',[
            'controller_name'=>'BookstoreController',
            'books'=> $books,
            'genres'=> $genres,
            'auteurs'=> $auteurs, 
            'form' =>  $form->createView(),
            'form2' =>  $form2->createView()
        ]);
    }


    #[Route('/books/m{id}', name: 'marks')]
    public function byMarks(Request $request,PaginatorInterface $paginator, int $id, LivreRepository $livreRepository){

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class , $search);
        $form->handleRequest($request);
        $form2 = $this->createForm(SearchType::class , $search);
        $form2->handleRequest($request);

        $repo = $this->objectManager->getRepository(Livre::class);

        if($request->get('keyword')){
            $donnees = $livreRepository->findByTitleField($search->getKeyword());
        }
        else if($request->get('dateFrom') and $request->get('dateFrom')){
            $donnees = $livreRepository->findByDate($search->getDateFrom(), $search->getDateTo());
        }
        else{
            $donnees = $repo->findBy(['note' => $id]);
        }

        

        $repo2 = $this->objectManager->getRepository(Genre::class);
        $genres = $repo2->findAll();


        $repo3 = $this->objectManager->getRepository(Auteur::class);
        $auteurs = $repo3->findAll();

        $books = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1), 
            10 
        );

        return $this->render('bookstore/books.html.twig',[
            'controller_name'=>'BookstoreController',
            'books'=> $books,
            'genres'=> $genres,
            'auteurs'=> $auteurs,
            'form' =>  $form->createView(),
            'form2' =>  $form2->createView()
        ]);
    }

   

}
