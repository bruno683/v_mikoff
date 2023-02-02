<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\User;
use PhpParser\Node\Expr\New_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    


    
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
        {
            
        }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
        $url = $this->adminUrlGenerator
            ->setController(ArticleCrudController::class)
            ->generateUrl();

        
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Viviane Mikoff');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');


        yield MenuItem::section('Utilisateurs');
        yield MenuItem::subMenu('Manage', 'fas fa-gear')->setSubItems([
            MenuItem::linkToCrud('Liste des utitlisateurs', 'fas fa-list', User::class),
            MenuItem::linkToCrud('Ajouter un utitlisateur', 'fas fa-plus', User::class),
        ]);
        
        yield MenuItem::section('Articles');
        yield MenuItem::subMenu('actions', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Listes des articles', 'fas fa-eye', Article::class),
            MenuItem::linkToCrud('Ajouter un article', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
        ]);
    }
}
