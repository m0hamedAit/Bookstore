<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Genre;
use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{

    private $objectManager;

    public function __construct(EntityManagerInterface  $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    #[Route('/authors', name: 'authors')]
    public function auteurs(Request $request,PaginatorInterface $paginator){
        $repo = $this->objectManager->getRepository(Auteur::class);

        $donnees = $repo->findBy([]);

        $auteurs = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 
        );
        
        return $this->render('auteur/authors.html.twig',[
            'controller_name'=>'AuteurController',
            'auteurs'=> $auteurs
        ]);
    }


    #[Route('/author/{id}', name: 'authorid')]
    public function auteur(int $id){

        $repo = $this->objectManager->getRepository(Auteur::class);

        $auteur = $repo->find($id);

        return $this->render('auteur/author.html.twig',[
            'controller_name'=>'AuteurController',
            'auteur'=> $auteur
        ]);
    }

}
