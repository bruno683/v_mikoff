<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\LesPatientsQueJeRecois;
use App\Entity\QuiSuisJe;
use App\Entity\User;
use PhpParser\Node\Expr\New_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use PhpParser\Node\Expr\Yield_;

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
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-list');



        yield MenuItem::section('Utilisateurs');
        yield MenuItem::subMenu('Manage', 'fas fa-gear')->setSubItems([
            MenuItem::linkToCrud('Liste des utitlisateurs', 'fas fa-list', User::class),
            MenuItem::linkToCrud('Ajouter un utitlisateur', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
        ]);
        
        yield MenuItem::section('Articles');
        yield MenuItem::subMenu('actions', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Liste des articles', 'fas fa-eye', Article::class),
            MenuItem::linkToCrud('Ajouter un article', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::section('Qui-suis je ?');
        yield MenuItem::subMenu('Actions', 'fas fa-gear')->setSubItems([
            MenuItem::linkToCrud('Liste des articles', 'fas fa-eye', QuiSuisJe::class),
            MenuItem::linkToCrud('Ajout de contenu', 'fas fa-plus', QuiSuisJe::class)->setAction(Crud::PAGE_NEW),
        ]);
        
        yield MenuItem::section('Les patients que je reçois');
        yield MenuItem::subMenu('Actions', 'fas fa-gear')->setSubItems([
            MenuItem::linkToCrud('Liste des articles', 'fas fa-eye', LesPatientsQueJeRecois::class),
            MenuItem::linkToCrud('Ajout de contenu', 'fas fa-plus', LesPatientsQueJeRecois::class)->setAction(Crud::PAGE_NEW),
        ]);
        
        yield MenuItem::section('retour à l\'accueil');
        yield MenuItem::linkToRoute('Accueil', 'fas fa-home' ,'app_home');

                
    }
}
