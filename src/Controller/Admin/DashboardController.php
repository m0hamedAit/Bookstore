<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use App\Entity\Livre;
use App\Entity\Genre;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class DashboardController extends AbstractDashboardController
{
    
    #[Route("/admin", name:"admin")]
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(LivreCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bookstore');
            
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to Home', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Books', 'fas fa-book', Livre::class);
        yield MenuItem::linkToCrud('Authors', 'fas fa-feather-alt', Auteur::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-at', Genre::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user-tie', User::class);
    }
}
