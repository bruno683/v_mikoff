<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepo ): Response
    {
        $title = "Vivianne Mikoff";
        $article = new Article();
        $posts = $articleRepo->findPostPublished($article);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'title' => $title,
            'posts' =>  $posts,
        ]);
    }
}
